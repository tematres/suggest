<?php
namespace suggest\DataType\RightsStatements;

use suggest\DataType\AbstractDataType;
use suggest\Suggester\RightsStatements\RightsStatementsSuggestAll;

class Rightsstatements extends AbstractDataType
{
    public function getSuggester()
    {
        return new RightsStatementsSuggestAll($this->services->get('Omeka\HttpClient'));
    }

    public function getName()
    {
        return 'valuesuggestall:rightsstatements:rightsstatements';
    }

    public function getLabel()
    {
        return 'RightsStatements.org: Rights statements for online cultural heritage'; // @translate
    }
}
