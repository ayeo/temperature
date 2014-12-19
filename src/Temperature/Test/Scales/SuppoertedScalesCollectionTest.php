<?php
namespace Temperature\Scales;


class SuppoertedScalesCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SuppoertedScalesCollection
     */
    private $collection;

    public function setUp()
    {
        $this->collection = new SuppoertedScalesCollection();
    }

    /**
     * @expectedException \Exception
     */
    public function testUnknownSymbol()
    {
        $this->collection->get('XXX');
    }

    public function testNonNumericValue()
    {
        $scale = $this->collection->get('C', 'testString');

        $this->assertEquals(0, $scale->getValue());
    }

    /**
     * @expectedException \Exception
     */
    public function testUnexistingClass()
    {
        $this->collection->addSupportedType('X', 'UnexistingClass');
    }


    /**
     * @expectedException \Exception
     */
    public function testInvalidClassType()
    {
        $this->collection->addSupportedType('X', 'Temperature\Scales\SuppoertedScalesCollection');
    }

    public function testValidClassType()
    {
        $this->collection->addSupportedType('X', 'Temperature\Scales\Scale\Kelvin');
    }
}