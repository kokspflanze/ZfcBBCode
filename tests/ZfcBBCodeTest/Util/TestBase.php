<?php


namespace ZfcBBCodeTest\Util;

use PHPUnit_Framework_TestCase as TestCase;

class TestBase extends TestCase
{
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    protected $class;

    /** @var  string */
    protected $className;

    /** @var array|null */
    protected $mockedMethodList = null;

    /** @var array */
    protected $mockedConstructorArgList = [];

    /**
     * @param bool $newInstance
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getClass($newInstance = false)
    {
        if (!$this->class || $newInstance) {
            $class = $this->getMockBuilder($this->className);
            if ($this->mockedConstructorArgList) {
                $class->setConstructorArgs($this->mockedConstructorArgList);
            } else {
                $class->disableOriginalConstructor();
            }
            $this->class = $class->setMethods($this->mockedMethodList)
                ->getMock();
        }

        return $this->class;
    }

    /**
     * @param $methodName
     * @return \ReflectionMethod
     */
    protected function getMethod($methodName)
    {
        $reflection = new \ReflectionClass($this->getClass());
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function getProperty($name)
    {
        $reflection = new \ReflectionProperty($this->getClass(), $name);
        $reflection->setAccessible(true);

        return $reflection->getValue($this->getClass());
    }
}