<?php
namespace suggest\DataType\Getty;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Getty\IaSearch;

class Ia extends AbstractDataType
{
    public function getSuggester()
    {
        return new IaSearch($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:getty:ia';
    }

    public function getLabel()
    {
        return 'Getty: Iconography Authority (IA)'; // @translate
    }
}
