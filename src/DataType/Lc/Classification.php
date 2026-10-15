<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Search;

class Classification extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/authorities/classification'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:classification';
    }

    public function getLabel()
    {
        return 'LC: Classification'; // @translate
    }
}
