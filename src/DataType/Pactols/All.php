<?php
namespace suggest\DataType\Pactols;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Pactols\PactolsAll;

class All extends AbstractDataType
{
    public function getSuggester()
    {
        return new PactolsAll($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:pactols:all';
    }

    public function getLabel()
    {
        return 'Pactols: All thesaurus'; // @translate
    }
}
