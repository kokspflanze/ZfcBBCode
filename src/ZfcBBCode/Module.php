<?php

namespace ZfcBBCode;

use Zend\ServiceManager\AbstractPluginManager;

class Module {
	public function getConfig() {
		return include __DIR__ . '/../../config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return [
			'Zend\Loader\StandardAutoloader' => [
				'namespaces' => [
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				],
			],
		];
	}

	public function getViewHelperConfig(){
		return array(
			'factories' => array(
				'bbCodeParser' => function(AbstractPluginManager $pluginManager){
					return new View\Helper\BBCodeParser($pluginManager->getServiceLocator());
				},
			)
		);
	}

	/**
	 * Expected to return \Zend\ServiceManager\Config object or array to
	 * seed such an object.
	 *
	 * @return array|\Zend\ServiceManager\Config
	 */
	public function getServiceConfig() {
		return [];
	}
}