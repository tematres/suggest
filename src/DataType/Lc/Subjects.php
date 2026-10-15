<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Search;

class Subjects extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/authorities/subjects'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:subjects';
    }

    public function getLabel()
    {
        return 'LC: Subject Headings'; // @translate
    }
}
