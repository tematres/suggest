<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Suggest;

class Countries extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'https://id.loc.gov/vocabulary/countries/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:countries';
    }

    public function getLabel()
    {
        return 'LC: MARC Countries'; // @translate
    }
}
