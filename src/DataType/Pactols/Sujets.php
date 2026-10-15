<?php
namespace suggest\DataType\Pactols;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Pactols\PactolsSujets;

class Sujets extends AbstractDataType
{
    public function getSuggester()
    {
        return new PactolsSujets($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:pactols:sujets';
    }

    public function getLabel()
    {
        return 'Pactols: Sujets (Subject)'; // @translate
    }
}
