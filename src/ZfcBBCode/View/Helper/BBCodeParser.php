<?php

namespace ZfcBBCode\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BBCodeParser extends AbstractHelper {

	/** @var ServiceLocatorInterface */
	protected $serviceLocator;

	/**
	 * @param ServiceLocatorInterface $serviceLocatorInterface
	 */
	public function __construct(ServiceLocatorInterface $serviceLocatorInterface){
		$this->setServiceLocator($serviceLocatorInterface);
	}

	/**
	 * @return ServiceLocatorInterface
	 */
	public function getServiceLocator(){
		return $this->serviceLocator;
	}

	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 *
	 * @return $this
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
		$this->serviceLocator = $serviceLocator;

		return $this;
	}


	/**
	 * @param $string
	 *
	 * @return string
	 */
	public function __invoke($string){
		/** @var \ZfcBBCode\Service\SBBCodeParser $parser */
		$parser = $this->getServiceLocator()->get('zfc-bbcode_parser');
		return $parser->getParsedText($string);
	}
}