<?php
namespace suggest\Service;

use Interop\Container\ContainerInterface;
use suggest\DataType\Thub\Thub;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ThubDataTypeFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, ?array $options = null)
    {
        return new Thub($services);
    }
}
