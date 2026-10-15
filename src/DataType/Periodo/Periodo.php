<?php
namespace suggest\DataType\Periodo;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Periodo\PeriodoSuggest;

class Periodo extends AbstractDataType
{
    public function getSuggester()
    {
        return new PeriodoSuggest;
    }

    public function getName()
    {
        return 'valuesuggest:periodo:periodo';
    }

    public function getLabel()
    {
        return 'PeriodO: A gazetteer of period definitions for linking and visualizing data'; // @translate
    }
}
