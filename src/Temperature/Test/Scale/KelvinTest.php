<?php
namespace Temperature\Test;

use Temperature\Scale\Kelvin;

class KelvinTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider conversionDataProvider
	 */
	public function testConversionToCelsius($kelvinValue, $celsiusValue)
	{
		$kelvin = new Kelvin($kelvinValue);
		$this->assertEquals($celsiusValue, $kelvin->getValueInCelsius());
	}

	/**
	 * @dataProvider conversionDataProvider
	 */
	public function testConversionFromCelsius($kelvinValue, $celsiusValue)
	{
		$kelvin = new Kelvin();
		$kelvin->setValueInCelsius($celsiusValue);
		$this->assertEquals($kelvinValue, $kelvin->getValue());
	}

	public function conversionDataProvider()
	{
		return [
			[100, -173.15],
			[-100, -373.15],
		];
	}
}