<?php
namespace suggest\DataType\Geonames;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Geonames\FeaturesSuggestAll;

class Features extends AbstractDataType
{
    public function getSuggester()
    {
        return new FeaturesSuggestAll;
    }

    public function getName()
    {
        return 'valuesuggestall:geonames:features';
    }

    public function getLabel()
    {
        return 'Geonames: GeoNames features'; // @translate
    }
}
