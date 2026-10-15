<?php
namespace suggest\DataType\Getty;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Getty\Sparql;

class Ulan extends AbstractDataType
{
    public function getSuggester()
    {
        return new Sparql($this->services->get('Omeka\HttpClient'), 'ulan');
    }

    public function getName()
    {
        return 'valuesuggest:getty:ulan';
    }

    public function getLabel()
    {
        return 'Getty: Union List of Artist Names (ULAN)'; // @translate
    }
}
