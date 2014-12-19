<?php
namespace Temperature\Test;

use Temperature\Factory\DefaultFactory;
use Temperature\Formatter\StandardFormatter;
use Temperature\Scales\Scale\Rankine;

class RankineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider conversionDataProvider
     */
    public function testConversionToCelsius($rankineValue, $celsiusValue)
    {
        $rankine = new Rankine($rankineValue);
        $this->assertEquals($celsiusValue, $rankine->getValueInCelsius(), '', 0.0001);
    }

    /**
     * @dataProvider conversionDataProvider
     */
    public function testConversionFromCelsius($rankineValue, $celsiusValue)
    {
        $rankine = new Rankine();
        $rankine->setValueInCelsius($celsiusValue);
        $this->assertEquals($rankineValue, $rankine->getValue(), '', 0.0001);
    }

    public function conversionDataProvider()
    {
        return [
            [100, -217.5944],
            [671.67, 100],
            [510.57, 10.5],
        ];
    }
}