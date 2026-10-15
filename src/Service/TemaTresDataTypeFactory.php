<?php
namespace suggest\Service;

use Interop\Container\ContainerInterface;
use suggest\DataType\TemaTres\TemaTres;
use Laminas\ServiceManager\Factory\FactoryInterface;

class TemaTresDataTypeFactory implements FactoryInterface
{
    const DEFAULT_API_URL = 'https://vocabularyserver.com/tbci/es/services.php';
    const SETTING_API_URL = 'valuesuggest_tematres_api_url';

    public function __invoke(ContainerInterface $services, $requestedName, ?array $options = null)
    {
        $dataType = new TemaTres($services);
        $settings = $services->get('Omeka\Settings');
        $dataType->setApiUrl($settings->get(self::SETTING_API_URL, self::DEFAULT_API_URL));
        return $dataType;
    }
}
