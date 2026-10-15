<?php
namespace suggest\DataType\Oclc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Oclc\FastSuggest;

class Fast extends AbstractDataType
{
    public function getSuggester()
    {
        return new FastSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:oclc:fast';
    }

    public function getLabel()
    {
        return 'OCLC: Faceted Application of Subject Terminologies (FAST)'; // @translate
    }
}
