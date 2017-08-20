<?php

namespace ZfcBBCodeTest\Service;

use ZfcBBCodeTest\Util\TestBase;

class SBBCodeParserTest extends TestBase
{
    /** @var string */
    protected $className = 'ZfcBBCode\Service\SBBCodeParser';

    /** @var array */
    protected $mockedConstructorArgList = [
        [
            'emoticons' => [
                'active' => false,
                'path' => [

                ],
            ],
        ]
    ];

    /**
     * @param $expected
     * @param $string
     * @dataProvider dataProviderTestGetParsedText
     */
    public function testGetParsedText($expected, $string)
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
    public function testGetParsedTextEmoticons($expected, $string)
    {
        $serverName = 'http://foo.bar';
        $this->mockedConstructorArgList = [
            [
                'emoticons' => [
                    'active' => true,
                    'path' => [
                        ':)' => $serverName . '/minified/emoticons/smile.png',
                        ':angel:' => $serverName . '/minified/emoticons/angel.png',
                        ':angry:' => $serverName . '/minified/emoticons/angry.png',
                        '8-)' => $serverName . '/minified/emoticons/cool.png',
                        ":'(" => $serverName . '/minified/emoticons/cwy.png',
                        ':ermm:' => $serverName . '/minified/emoticons/ermm.png',
                        ':D' => $serverName . '/minified/emoticons/grin.png',
                        '<3' => $serverName . '/minified/emoticons/heart.png',
                        ':(' => $serverName . '/minified/emoticons/sad.png',
                        ':O' => $serverName . '/minified/emoticons/shocked.png',
                        ':P' => $serverName . '/minified/emoticons/tongue.png',
                        ';)' => $serverName . '/minified/emoticons/wink.png',
                        ':alien:' => $serverName . '/minified/emoticons/alien.png',
                        ':blink:' => $serverName . '/minified/emoticons/blink.png',
                        ':blush:' => $serverName . '/minified/emoticons/blush.png',
                        ':cheerful:' => $serverName . '/minified/emoticons/cheerful.png',
                        ':devil:' => $serverName . '/minified/emoticons/devil.png',
                        ':dizzy:' => $serverName . '/minified/emoticons/dizzy.png',
                        ':getlost:' => $serverName . '/minified/emoticons/getlost.png',
                        ':kissing:' => $serverName . '/minified/emoticons/kissing.png',
                        ':ninja:' => $serverName . '/minified/emoticons/ninja.png',
                        ':pinch:' => $serverName . '/minified/emoticons/pinch.png',
                        ':pouty:' => $serverName . '/minified/emoticons/pouty.png',
                        ':sick:' => $serverName . '/minified/emoticons/sick.png',
                        ':sideways:' => $serverName . '/minified/emoticons/sideways.png',
                        ':silly:' => $serverName . '/minified/emoticons/silly.png',
                        ':sleeping:' => $serverName . '/minified/emoticons/sleeping.png',
                        ':unsure:' => $serverName . '/minified/emoticons/unsure.png',
                        ':woot:' => $serverName . '/minified/emoticons/woot.png',
                        ':wassat:' => $serverName . '/minified/emoticons/wassat.png'
                    ],
                ],
            ]
        ];

        $this->testGetParsedText($expected, $string);
    }

    /**
     * @param $expected
     * @param $string
     * @dataProvider dataProviderTestIsTextValidEmoticons
     * @dataProvider dataProviderTestIsTextValid
     */
    public function testIsTextValid($expected, $string)
    {
        /** @var \ZfcBBCode\Service\SBBCodeParser $class */
        $class = $this->getClass();
        $result = $class->isTextValid($string);

        $this->assertEquals($expected, $result, $string);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetParsedTextEmoticons()
    {
        $data = $this->dataProviderTestGetParsedText();
        $data = array_merge($data, [
            [
                '<img alt=":)" src="http://foo.bar/minified/emoticons/smile.png" />',
                ':)'
            ],
            [
                '<img alt=":O" src="http://foo.bar/minified/emoticons/shocked.png" />',
                ':O'
            ],
            [
                '<img alt=":dizzy:" src="http://foo.bar/minified/emoticons/dizzy.png" />',
                ':dizzy:'
            ],
            [
                '<img alt=":getlost:" src="http://foo.bar/minified/emoticons/getlost.png" />',
                ':getlost:'
            ],
            [
                '<img alt=":unsure:" src="http://foo.bar/minified/emoticons/unsure.png" />',
                ':unsure:'
            ],
            [
                '<img alt=":wassat:" src="http://foo.bar/minified/emoticons/wassat.png" />',
                ':wassat:'
            ],
        ]);

        return $data;
    }

    /**
     * @return array
     */
    public function dataProviderTestGetParsedText()
    {
        return [
            [
                'foobar',
                'foobar'
            ],
            [
                '[URL]foobar',
                '[URL]foobar'
            ],
            [
                '<a href="https://img.com">https://img.com</a>',
                'https://img.com'
            ],
            [
                '<img alt="http://img.com/pic.jpg" src="http://img.com/pic.jpg" />',
                '[img]http://img.com/pic.jpg[/img]'
            ],
            [
                '<img alt="https://img.com/pic.jpg" src="https://img.com/pic.jpg" />',
                '[img]https://img.com/pic.jpg[/img]'
            ],
            [
                '<strong>foobar</strong> <img alt="http://img.bar.com/baz.jpg" src="http://img.bar.com/baz.jpg" />',
                '[b]foobar[/b] [img]http://img.bar.com/baz.jpg[/img]'
            ],
        ];
    }

    /**
     * @return array
     */
    public function dataProviderTestIsTextValid()
    {
        return [
            [
                true,
                'foobar'
            ],
            [
                true,
                '[URL]foobar'
            ],
            [
                true,
                'https://img.com'
            ],
            [
                true,
                '[img]http://img.com/pic.jpg[/img]'
            ],
            [
                true,
                '[img]https://img.com/pic.jpg[/img]'
            ],
            [
                true,
                '[b]foobar[/b] [img]http://img.bar.com/baz.jpg[/img]'
            ],
            [
                false,
                '[img]http://img.com/pic.jpg[/ig]'
            ],
            [
                false,
                '[b]foobar[/d]]'
            ],
            [
                false,
                '[b]foobar[/d] [img]http://img.com/pic.jpg[/ig]'
            ],
            [
                false,
                '[b]foobar[/d] [img]http://img.com/pic.jpg[/img]'
            ],
        ];
    }

    /**
     * @return array
     */
    public function dataProviderTestIsTextValidEmoticons()
    {
        $this->mockedConstructorArgList = [
            [
                'emoticons' => [
                    'active' => true,
                    'path' => [

                    ],
                ],
            ]
        ];

        $data = $this->dataProviderTestIsTextValid();
        $data = array_merge($data, [
            [
                true,
                ':)'
            ],
            [
                true,
                ':O'
            ],
            [
                true,
                ':dizzy:'
            ],
            [
                true,
                ':getlost:'
            ],
            [
                true,
                ':unsure:'
            ],
            [
                true,
                ':wassat:'
            ],
            [
                true,
                ':wasdfgsat:'
            ],
            [
                true,
                ':wÄasdfgsat:'
            ],
            [
                true,
                ':wasdfgsatdfg'
            ],
            [
                true,
                ':wasdfgsat:dfh'
            ],
            [
                true,
                'dfh:wasdfgsat:'
            ],
        ]);

        return $data;
    }
}
