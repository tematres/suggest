<?php
namespace suggest\Service;

use Interop\Container\ContainerInterface;
use suggest\DataType\Orcid\Orcid;
use Laminas\ServiceManager\Factory\FactoryInterface;

class OrcidDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, ?array $options = null)
    {
        return new Orcid($services);
    }
}
