<?php

namespace ZfcBBCode\Validator;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BBCodeValidFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return object|BBCodeValid
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new BBCodeValid($container->get('zfc-bbcode_parser'));
    }

}
