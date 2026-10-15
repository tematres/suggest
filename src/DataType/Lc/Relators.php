<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Suggest;

class Relators extends AbstractDataType
{
    public function getSuggester()
    {
        return new Suggest(
            $this->services->get('Omeka\HttpClient'),
            'https://id.loc.gov/vocabulary/relators/suggest'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:relators';
    }

    public function getLabel()
    {
        return 'LC: MARC Relators'; // @translate
    }
}
