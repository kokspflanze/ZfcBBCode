<?php


namespace ZfcBBCode\View\Helper;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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

    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return BBCodeParser
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator->getServiceLocator(), BBCodeParser::class);
    }


}