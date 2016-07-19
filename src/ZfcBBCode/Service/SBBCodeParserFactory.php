<?php


namespace ZfcBBCode\Service;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SBBCodeParserFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return SBBCodeParser
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new SBBCodeParser($container->get('Configuration')['zfc-bbcode']);
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return SBBCodeParser
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, SBBCodeParser::class);
    }


}