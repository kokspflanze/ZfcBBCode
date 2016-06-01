<?php


namespace ZfcBBCode\View\Helper;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BBCodeParserFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return BBCodeParser
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new BBCodeParser($container->get('zfc-bbcode_parser'));
    }

}