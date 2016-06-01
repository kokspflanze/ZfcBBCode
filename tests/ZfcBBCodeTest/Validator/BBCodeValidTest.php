<?php


namespace ZfcBBCodeTest\Validator;


use ZfcBBCodeTest\Util\TestBase;

class BBCodeValidTest extends TestBase
{
    protected $className = 'ZfcBBCode\Validator\BBCodeValid';

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
     * @dataProvider dataProviderTestIsValid
     */
    public function testIsValid( $expected, $string )
    {
        /** @var \ZfcBBCode\Validator\BBCodeValid $class */
        $class = $this->getClass();
        $method = $this->getMethod('isValid');
        $result = $method->invokeArgs($class, [$string]);

        $this->assertSame($expected, $result);
        $this->assertSame($expected, !(bool) $class->getMessages());


        $method = $this->getMethod('getValue');
        $result = $method->invokeArgs($class, []);
        $this->assertSame($string, $result);
    }

    public function testGetBBCodeParser()
    {
        $result = $this->getProperty('bbCodeParser');

        $this->assertInstanceOf('\ZfcBBCode\Service\ParserInterface', $result);
    }

    public function dataProviderTestIsValid()
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

}
