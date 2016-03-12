<?php

namespace ZfcBBCode;

use Zend\ServiceManager\AbstractPluginManager;

class Module
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                'bbCodeParser' => function (AbstractPluginManager $pluginManager) {
                    /** @var \ZfcBBCode\Service\ParserInterface $bbCodeParser */
                    $bbCodeParser = $pluginManager->getServiceLocator()->get('zfc-bbcode_parser');
                    return new View\Helper\BBCodeParser($bbCodeParser);
                },
            ]
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'aliases' => [
                'zfc-bbcode_parser' => Service\SBBCodeParser::class,
            ],
            'factories' => [
                Service\SBBCodeParser::class => function ($sm) {
                    /** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
                    $config = $sm->get('Configuration');
                    return new Service\SBBCodeParser($config['zfc-bbcode']);
                },
            ],
        ];
    }
}