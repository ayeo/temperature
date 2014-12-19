<?php
namespace Temperature\Test\Factory;


use Temperature\Factory\DefaultFactory;
use Temperature\Scale\Kelvin;

class DafaultFacotryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DefaultFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new DefaultFactory();
    }

    /**
     * @dataProvider dataProvider
     */
    public function testConversion($scale1Value, $scale1Symbol, $scale2Value, $scale2Symbol)
    {
        $scale1 = $this->factory->build($scale1Value, $scale1Symbol);
        $scale2 = $this->factory->buildByScale($scale1, $scale2Symbol);
        $this->assertEquals($scale2->getValue(), $scale2Value, '', 0.0001);
    }

    public function dataProvider()
    {
        return [
            [100, 'C', 100, 'C'],
            [100, 'C', 212, 'F'],
            [100, 'C', 373.15, 'K'],
            [100, 'C', 671.67, 'R'],
            [100, 'C', 80, 'Re'],
            [100, 'F', 37.77777, 'C'],
            [100, 'F', 100, 'F'],
            [100, 'F', 310.92777, 'K'],
            [100, 'F', 559.67, 'R'],
            [100, 'F', 30.22222, 'Re'],
            [100, 'K', -173.15, 'C'],
            [100, 'K', -279.67, 'F'],
            [100, 'K', 100, 'K'],
            [100, 'K', 180, 'R'],
            [100, 'K', -138.52, 'Re'],
            [100, 'R', -217.5944, 'C'],
            [100, 'R', -359.67, 'F'],
            [100, 'R', 55.5555, 'K'],
            [100, 'R', 100, 'R'],
            [100, 'R', -174.0755, 'Re'],
            [100, 'Re', 125, 'C'],
            [100, 'Re', 257, 'F'],
            [100, 'Re', 398.15, 'K'],
            [100, 'Re', 716.67, 'R'],
            [100, 'Re', 100, 'Re'],
        ];
    }

    public function testSetAutoConvert()
    {
        $this->factory->setAutoconvertTo('C');
        $scale = $this->factory->build(50, 'F');

        $this->assertEquals('C', $scale->getRawSymbol());
    }

    public function testPrecisionDoesNotOverwriteFormatterSettings()
    {
        $factory = new DefaultFactory();
        $factory->getFormatter()->setPrecision(2);

        $scale1 = $factory->build(100.1111, 'K')->setPrecision(0);
        $scale2 = $factory->build(200.2222, 'K');

        $this->assertEquals('100 K', (string) $scale1);
        $this->assertEquals('200.22 K', (string) $scale2);
    }

    public function testGetSupportedScales()
    {
        $this->assertInstanceOf('Temperature\Scales\SuppoertedScalesCollection', $this->factory->getSupportedScales());
    }
}