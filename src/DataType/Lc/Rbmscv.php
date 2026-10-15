<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Suggest;

class Rbmscv extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'https://id.loc.gov/vocabulary/rbmscv/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:rbmscv';
    }

    public function getLabel()
    {
        return 'LC: Rare Materials Cataloging'; // @translate
    }
}
