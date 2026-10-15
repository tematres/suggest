<?php
namespace suggest\DataType\Lc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Lc\Search;

class All extends AbstractDataType
{
    public function getSuggester()
    {
        return new Search($this->services->get('Omeka\HttpClient'), '');
    }

    public function getName()
    {
        return 'valuesuggest:lc:all';
    }

    public function getLabel()
    {
        return 'LC: All'; // @translate
    }
}
