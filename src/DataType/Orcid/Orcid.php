<?php
namespace suggest\DataType\Orcid;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\Orcid\OrcidSuggest;

class Orcid extends AbstractDataType
{
    public function getSuggester()
    {
        return new OrcidSuggest($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggest:orcid:orcid';
    }

    public function getLabel()
    {
        return 'ORCID: Open Researcher and Contributor ID'; // @translate
    }
}
