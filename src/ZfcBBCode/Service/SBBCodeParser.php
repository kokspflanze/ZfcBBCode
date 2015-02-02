<?php

namespace ZfcBBCode\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class SBBCodeParser implements ServiceManagerAwareInterface {

	/** @var ServiceManager */
	protected $serviceManager;

	/**
	 * get parsed text
	 * @param $text
	 *
	 * @return string
	 */
	public function getParsedText( $text ){

		$parser = new \SBBCodeParser\Node_Container_Document(true, false);

		$config = $this->getServiceLocator()->get('Config')['zfc-bbcode'];
		if($config['emoticons']['active']){
			$parser->add_emoticons($config['emoticons']['path']);
		}

		$result = $parser->parse($text)
			->detect_links()
			->detect_emails()
			->detect_emoticons()
			->get_html();

		return $result;
	}

	/**
	 * check if the text is correct
	 * @param $text
	 *
	 * @return bool
	 */
	public function isTextValid( $text ){

		$parser = new \SBBCodeParser\Node_Container_Document();

		$result = true;
		try {
			$parser->parse($text)
				->detect_links()
				->detect_emails()
				->detect_emoticons()
				->get_html();
		}catch(\Exception $e){
			$result = false;
		}

		return $result;
	}


	/**
	 * @return ServiceManager
	 */
	public function getServiceManager(){
		return $this->serviceManager;
	}

	/**
	 * @param ServiceManager $oServiceManager
	 *
	 * @return $this
	 */
	public function setServiceManager( ServiceManager $oServiceManager ) {
		$this->serviceManager = $oServiceManager;

		return $this;
	}
}