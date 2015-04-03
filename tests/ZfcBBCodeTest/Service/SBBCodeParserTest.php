<?php

namespace ZfcBBCodeTest\Service;

use ZfcBBCodeTest\Util\TestBase;

class SBBCodeParserTest extends TestBase
{
    protected $className = 'ZfcBBCode\Service\SBBCodeParser';

    /**
     * @param $expected
     * @param $string
     * @dataProvider dataProviderTestGetParsedText
     */
    public function testGetParsedText( $expected, $string )
    {
        /** @var \ZfcBBCode\Service\SBBCodeParser $class */
        $class = $this->getClass();
        $result = $class->getParsedText($string);

        $this->assertEquals($expected, $result);
    }

    /**
     * @param $expected
     * @param $string
     * @dataProvider dataProviderTestGetParsedTextEmoticons
     */
    public function testGetParsedTextEmoticons( $expected, $string )
    {
        $config = $this->serviceManager->get('Config');
        $config['zfc-bbcode']['emoticons']['active'] = true;
        $this->serviceManager->setAllowOverride(true)->setService('Config', $config);

        $this->testGetParsedText($expected, $string);
    }

    /**
     * @param $expected
     * @param $string
     * @dataProvider dataProviderTestIsTextValid
     */
    public function testIsTextValid( $expected, $string )
    {
        /** @var \ZfcBBCode\Service\SBBCodeParser $class */
        $class = $this->getClass();
        $result = $class->isTextValid($string);

        $this->assertEquals($expected, $result, $string);
    }

    /**
     * @param $expected
     * @param $string
     * @dataProvider dataProviderTestIsTextValidEmoticons
     */
    public function testIsTextValidEmoticons( $expected, $string )
    {
        $config = $this->serviceManager->get('Config');
        $config['zfc-bbcode']['emoticons']['active'] = true;
        $this->serviceManager->setAllowOverride(true)->setService('Config', $config);

        $this->testIsTextValid($expected, $string);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetParsedTextEmoticons()
    {
        $data = $this->dataProviderTestGetParsedText();
        $data = array_merge( $data, array(
            array(
                '<img alt=":)" src="http://foo.bar/minified/emoticons/smile.png" />',
                ':)'
            ),
            array(
                '<img alt=":O" src="http://foo.bar/minified/emoticons/shocked.png" />',
                ':O'
            ),
            array(
                '<img alt=":dizzy:" src="http://foo.bar/minified/emoticons/dizzy.png" />',
                ':dizzy:'
            ),
            array(
                '<img alt=":getlost:" src="http://foo.bar/minified/emoticons/getlost.png" />',
                ':getlost:'
            ),
            array(
                '<img alt=":unsure:" src="http://foo.bar/minified/emoticons/unsure.png" />',
                ':unsure:'
            ),
            array(
                '<img alt=":wassat:" src="http://foo.bar/minified/emoticons/wassat.png" />',
                ':wassat:'
            ),
        ));

        return $data;
    }

    /**
     * @return array
     */
    public function dataProviderTestGetParsedText()
    {
        return array(
            array(
                'foobar',
                'foobar'
            ),
            array(
                '[URL]foobar',
                '[URL]foobar'
            ),
            array(
                '<a href="https://img.com">https://img.com</a>',
                'https://img.com'
            ),
            array(
                '<img alt="http://img.com/pic.jpg" src="http://img.com/pic.jpg" />',
                '[img]http://img.com/pic.jpg[/img]'
            ),
            array(
                '<img alt="https://img.com/pic.jpg" src="https://img.com/pic.jpg" />',
                '[img]https://img.com/pic.jpg[/img]'
            ),
            array(
                '<strong>foobar</strong> <img alt="http://img.bar.com/baz.jpg" src="http://img.bar.com/baz.jpg" />',
                '[b]foobar[/b] [img]http://img.bar.com/baz.jpg[/img]'
            ),
        );
    }

    public function dataProviderTestIsTextValid()
    {
        return array(
            array(
                true,
                'foobar'
            ),
            array(
                true,
                '[URL]foobar'
            ),
            array(
                true,
                'https://img.com'
            ),
            array(
                true,
                '[img]http://img.com/pic.jpg[/img]'
            ),
            array(
                true,
                '[img]https://img.com/pic.jpg[/img]'
            ),
            array(
                true,
                '[b]foobar[/b] [img]http://img.bar.com/baz.jpg[/img]'
            ),
        );
    }

    public function dataProviderTestIsTextValidEmoticons()
    {
        $data = $this->dataProviderTestIsTextValid();
        $data = array_merge( $data, array(
            array(
                true,
                ':)'
            ),
            array(
                true,
                ':O'
            ),
            array(
                true,
                ':dizzy:'
            ),
            array(
                true,
                ':getlost:'
            ),
            array(
                true,
                ':unsure:'
            ),
            array(
                true,
                ':wassat:'
            ),
            array(
                true,
                ':wasdfgsat:'
            ),
            array(
                true,
                ':wÄasdfgsat:'
            ),
            array(
                true,
                ':wasdfgsatdfg'
            ),
            array(
                true,
                ':wasdfgsat:dfh'
            ),
            array(
                true,
                'dfh:wasdfgsat:'
            ),
        ));

        return $data;
    }
}
