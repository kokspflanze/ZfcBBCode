<?php

namespace ZfcBBCode\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use ZfcBBCode\Service\ParserInterface;

class BBCodeParser extends AbstractHelper
{
    /** @var  ParserInterface */
    protected $bbCodeParser;

    /**
     * BBCodeParser constructor.
     * @param ParserInterface $bbCodeParser
     */
    public function __construct(ParserInterface $bbCodeParser)
    {
        $this->bbCodeParser = $bbCodeParser;
    }

    /**
     * @param $string
     *
     * @return string
     */
    public function __invoke($string)
    {
        return $this->bbCodeParser->getParsedText($string);
    }
}