<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Search;

class Childrenssubjects extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search(
            $this->services->get('Omeka\HttpClient'),
            'scheme:http://id.loc.gov/authorities/childrensSubjects'
        );
    }

    public function getName()
    {
        return 'valuesuggest:lc:childrensSubjects';
    }

    public function getLabel()
    {
        return 'LC: Children\'s Subject Headings'; // @translate
    }
}
