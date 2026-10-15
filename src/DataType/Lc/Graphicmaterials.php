<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Search;

class Graphicmaterials extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/vocabulary/graphicMaterials'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:graphicMaterials';
    }

    public function getLabel()
    {
        return 'LC: Thesaurus for Graphic Materials'; // @translate
    }
}
