<?php
namespace suggest\DataType\Getty;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Getty\Sparql;

class Aat extends AbstractDataType
{
    public function getSuggester()
    {
        return new Sparql($this->services->get('Omeka\HttpClient'), 'aat');
    }

    public function getName()
    {
        return 'valuesuggest:getty:aat';
    }

    public function getLabel()
    {
        return 'Getty: Art & Architecture Thesaurus (AAT)'; // @translate
    }
}
