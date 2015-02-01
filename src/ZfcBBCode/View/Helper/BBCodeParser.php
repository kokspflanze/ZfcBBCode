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

		$parser = new \SBBCodeParser\Node_Container_Document(true, false);

		$config = $this->getServiceLocator()->get('Config')['zfc-bbcode'];
		if($config['emoticons']['active']){
			$parser->add_emoticons($config['emoticons']['path']);
		}

		$result = $parser->parse($string)
			->detect_links()
			->detect_emails()
			->detect_emoticons()
			->get_html();

		return $result;
	}
}