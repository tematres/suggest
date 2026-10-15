<?php
namespace suggest\DataType\Getty;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Getty\Sparql;

class Tgn extends AbstractDataType
{
    public function getSuggester()
    {
        return new Sparql($this->services->get('Omeka\HttpClient'), 'tgn');
    }

    public function getName()
    {
        return 'valuesuggest:getty:tgn';
    }

    public function getLabel()
    {
        return 'Getty: Thesaurus of Geographic Names (TGN)'; // @translate
    }
}
