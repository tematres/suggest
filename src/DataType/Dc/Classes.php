<?php
namespace suggest\DataType\Dc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Dc\ClassesSuggestAll;

class Classes extends AbstractDataType
{
    public function getSuggester()
    {
        return new ClassesSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:dc:classes';
    }

    public function getLabel()
    {
        return 'Dublin Core: Classes'; // @translate
    }
}
