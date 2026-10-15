<?php
namespace suggest\DataType\Dc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Dc\TermsSuggestAll;

class Terms extends AbstractDataType
{
    public function getSuggester()
    {
        return new TermsSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:dc:terms';
    }

    public function getLabel()
    {
        return 'Dublin Core: Terms'; // @translate
    }
}
