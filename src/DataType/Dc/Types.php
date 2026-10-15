<?php
namespace suggest\DataType\Dc;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Dc\TypesSuggestAll;

class Types extends AbstractDataType
{
    public function getSuggester()
    {
        return new TypesSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:dc:types';
    }

    public function getLabel()
    {
        return 'Dublin Core: Types'; // @translate
    }
}
