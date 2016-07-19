<?php


namespace ZfcBBCode\Service;

interface ParserInterface
{

    /**
     * get parsed text
     *
     * @param string $text
     * @return string
     */
    public function getParsedText($text);

    /**
     * check if the text is correct
     *
     * @param string $text
     * @return bool
     */
    public function isTextValid($text);
}