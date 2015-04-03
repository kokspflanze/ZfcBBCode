<?php


namespace ZfcBBCode\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

interface ParserInterface extends ServiceManagerAwareInterface
{

    /**
     * get parsed text
     *
     * @param $text
     * @return string
     */
    public function getParsedText( $text );

    /**
     * check if the text is correct
     *
     * @param $text
     * @return bool
     */
    public function isTextValid( $text );
}