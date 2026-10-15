<?php
namespace suggest\DataType\TemaTres;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\TemaTres\Api;

class TemaTres extends AbstractDataType
{
    protected $apiUrl;

    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function getSuggester()
    {
        return new Api(
            $this->services->get('Omeka\HttpClient'),
            $this->apiUrl
        );
    }

    public function getName()
    {
        return 'valuesuggest:tematres';
    }

    public function getLabel()
    {
        return 'TemaTres'; // @translate
    }
}
