<?php


namespace ZfcBBCodeTest\View\Helper;


use ZfcBBCodeTest\Util\TestBase;

class BBCodeParserTest extends TestBase
{
    protected $className = 'ZfcBBCode\View\Helper\BBCodeParser';

    protected function setUp()
    {
        parent::setUp();

        $parser = $this->getMockBuilder('ZfcBBCode\Service\SBBCodeParser')
            ->setConstructorArgs([
                [
                    'emoticons' => [
                        'active' => false,
                        'path' => [

                        ],
                    ],
                ],
            ])
            ->setMethods(null)
            ->getMock();

        $this->mockedConstructorArgList = [
            $parser
        ];
    }

    /**
     * @param $expected
     * @param $string
     * @dataProvider dataProviderTestInvoke
     */
    public function testInvoke( $expected, $string )
    {
        $class = $this->getClass();

        $result = $class->__invoke($string);

        $this->assertSame($expected, $result);
    }

    /**
     * @return array
     */
    public function dataProviderTestInvoke()
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


}
