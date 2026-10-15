<?php
namespace suggest\DataType\Homosaurus;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Homosaurus\HomosaurusSuggest;

class Homosaurus extends AbstractDataType
{
    public function getSuggester()
    {
        return new HomosaurusSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:homosaurus:homosaurus';
    }

    public function getLabel()
    {
        return 'Homosaurus: an international LGBTQ linked data vocabulary'; // @translate
    }
}
