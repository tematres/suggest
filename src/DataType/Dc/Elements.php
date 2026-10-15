<?php
namespace suggest\DataType\Dc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Dc\ElementsSuggestAll;

class Elements extends AbstractDataType
{
    public function getSuggester()
    {
        return new ElementsSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:dc:elements';
    }

    public function getLabel()
    {
        return 'Dublin Core: Elements'; // @translate
    }
}
