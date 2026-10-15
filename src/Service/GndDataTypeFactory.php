<?php
namespace suggest\Service;

use Interop\Container\ContainerInterface;
use suggest\DataType\Gnd\Gnd;
use Laminas\ServiceManager\Factory\FactoryInterface;

class GndDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, ?array $options = null)
    {
        return new Gnd($services);
    }
}
