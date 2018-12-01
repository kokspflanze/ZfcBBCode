<?php

namespace ZfcBBCode\View\Helper;

use Zend\View\Helper\AbstractHelper;
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
     * @param string $string
     *
     * @return string
     */
    public function __invoke(string $string): string
    {
        return $this->bbCodeParser->getParsedText($string);
    }
}