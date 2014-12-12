<?php
namespace Temperature\Test;

use Temperature\Scale\Farenheit;

class FarenheitTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider conversionDataProvider
	 */
	public function testConversionToCelsius($farenheitValue, $celsiusValue)
	{
		$kelvin = new Farenheit($farenheitValue);
		$this->assertEquals($celsiusValue, $kelvin->getValueInCelsius());
	}

	/**
	 * @dataProvider conversionDataProvider
	 */
	public function testConversionFromCelsius($farenheitValue, $celsiusValue)
	{
		$farenheit = new Farenheit();
		$farenheit->setValueInCelsius($celsiusValue);
		$this->assertEquals($farenheitValue, $farenheit->getValue());
	}

	public function conversionDataProvider()
	{
		return [
			[32, 0],
			[212, 100],
			[10, -12.2222222222],
		];
	}
}