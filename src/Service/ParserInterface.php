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
    public function getParsedText(string $text): string;

    /**
     * check if the text is correct
     *
     * @param string $text
     * @return bool
     */
    public function isTextValid(string $text): bool;
}