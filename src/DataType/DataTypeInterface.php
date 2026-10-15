<?php
namespace suggest\DataType;

interface DataTypeInterface
{
    /**
     * Get the suggestor needed to retrieve suggestions.
     *
     * @return \suggest\Suggester\SuggesterInterface
     */
    public function getSuggester();
}
