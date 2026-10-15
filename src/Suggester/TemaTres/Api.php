<?php
namespace suggest\Suggester\TemaTres;

use Laminas\Http\Client;
use RuntimeException;
use suggest\Suggester\SuggesterInterface;

class Api implements SuggesterInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiUrl;

    public function __construct(Client $client, $apiUrl)
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
    }

    public function getSuggestions($query, $lang = null)
    {
        if (!is_string($query) || '' === trim($query)) {
            return [];
        }

        $response = $this->client
            ->setUri($this->apiUrl)
            ->setMethod('GET')
            ->setParameterGet([
                'task' => 'suggestDetails',
                'arg' => $query,
                'output' => 'json',
            ])
            ->send();

        if (!$response->isSuccess()) {
            throw new RuntimeException(sprintf(
                'TemaTres API returned HTTP status %d.',
                $response->getStatusCode()
            ));
        }

        try {
            $result = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new RuntimeException('TemaTres API returned invalid JSON.', 0, $e);
        }
        if (!is_array($result)) {
            throw new RuntimeException('TemaTres API returned an unexpected response.');
        }
        if (isset($result['error'])) {
            throw new RuntimeException('TemaTres API reported an error.');
        }

        $terms = $result;
        foreach (['result', 'data'] as $payloadKey) {
            if (!array_key_exists($payloadKey, $result)) {
                continue;
            }
            if (is_string($result[$payloadKey])) {
                try {
                    $terms = json_decode($result[$payloadKey], true, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException $e) {
                    throw new RuntimeException('TemaTres API returned invalid JSON data.', 0, $e);
                }
            } elseif (is_array($result[$payloadKey])) {
                $terms = $result[$payloadKey];
            } else {
                throw new RuntimeException('TemaTres API returned an unexpected data payload.');
            }
            break;
        }
        if (!is_array($terms)) {
            throw new RuntimeException('TemaTres API returned an unexpected term list.');
        }
        if (isset($terms['term_id']) || isset($terms['tema_id'])) {
            $terms = [$terms];
        }

        $suggestions = [];
        foreach ($terms as $key => $term) {
            if ('resume' === $key) {
                continue;
            }
            if (!is_array($term)) {
                throw new RuntimeException('TemaTres API returned an invalid term record.');
            }
            $termId = $term['term_id'] ?? $term['tema_id'] ?? null;
            $label = $term['string'] ?? $term['term'] ?? null;
            if ((!is_string($termId) && !is_int($termId))
                || !preg_match('/^[1-9][0-9]*$/', (string) $termId)
                || !is_string($label)
                || '' === trim($label)
            ) {
                throw new RuntimeException('TemaTres API returned a term without a valid ID and label.');
            }
            $suggestions[] = [
                'value' => $label,
                'data' => [
                    'uri' => $this->getTermUri((string) $termId),
                    'info' => null,
                ],
            ];
        }

        return $suggestions;
    }

    private function getTermUri($termId)
    {
        $url = parse_url($this->apiUrl);
        if (false === $url || empty($url['scheme']) || empty($url['host'])) {
            throw new RuntimeException('The configured TemaTres API URL is invalid.');
        }
        $basePath = rtrim(str_replace('\\', '/', dirname($url['path'] ?? '/')), '/');
        $port = isset($url['port']) ? ':' . $url['port'] : '';
        return sprintf(
            '%s://%s%s%s/?tema=%s',
            $url['scheme'],
            $url['host'],
            $port,
            $basePath,
            rawurlencode($termId)
        );
    }
}
