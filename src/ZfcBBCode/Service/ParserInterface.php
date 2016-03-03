<?php


namespace ZfcBBCode\Service;

interface ParserInterface
{

    /**
     * get parsed text
     *
     * @param $text
     * @return string
     */
    public function getParsedText($text);

    /**
     * check if the text is correct
     *
     * @param $text
     * @return bool
     */
    public function isTextValid($text);
}