<?php

namespace ZfcBBCode\Service;

use SBBCodeParser\Node_Container_Document;

class SBBCodeParser implements ParserInterface
{
    /** @var array */
    protected $configData = [];

    /**
     * SBBCodeParser constructor.
     * @param array $configData
     */
    public function __construct(array $configData)
    {
        $this->configData = $configData;
    }

    /**
     * get parsed text
     * @param $text
     *
     * @return string
     */
    public function getParsedText($text)
    {
        $parser = new Node_Container_Document(true, false);

        if ($this->configData['emoticons']['active']) {
            $parser->add_emoticons($this->configData['emoticons']['path']);
        }

        $result = $parser->parse($text)
            ->detect_links()
            ->detect_emails();

        if ($this->configData['emoticons']['active']) {
            $result->detect_emoticons();
        }

        return $result->get_html();
    }

    /**
     * check if the text is correct
     * @param $text
     *
     * @return bool
     */
    public function isTextValid($text)
    {
        $parser = new Node_Container_Document();

        if ($this->configData['emoticons']['active']) {
            $parser->add_emoticons($this->configData['emoticons']['path']);
        }

        $result = true;
        try {
            $parser->parse($text)
                ->detect_links()
                ->detect_emails();

            if ($this->configData['emoticons']['active']) {
                $parser->detect_emoticons();
            }

            $parser->get_html();

        } catch (\Exception $e) {
            $result = false;
        }

        return $result;
    }

}