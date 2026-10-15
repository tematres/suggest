<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Suggest;

class Geographicareas extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'https://id.loc.gov/vocabulary/geographicAreas/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:geographicAreas';
    }

    public function getLabel()
    {
        return 'LC: MARC Geographic Areas'; // @translate
    }
}
