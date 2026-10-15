<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Suggest;

class Iso6395 extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'https://id.loc.gov/vocabulary/iso639-5/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:iso6395';
    }

    public function getLabel()
    {
        return 'LC: ISO639-5 Languages'; // @translate
    }
}
