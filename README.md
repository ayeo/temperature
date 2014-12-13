Temperature
===========

Simple library to handle temperature scales. Features:
* Display formatted tempteratue (e.g 100 °C)
* Simple convert beetwen different scales

### Supported temperature scales
* Celsius (C)
* Kelvin (K)
* Farenheit (F)
* Rankine (R)
* Reaumur (Re)

### Install using Composer
```
require: {
	"ayeo/temperature": "dev-master"
}
```

### Basic usage
```
use Temperature\Factory\DefaultFactory as TemperatureFactory;

$factory = new TemperatureFactory();
$temperature = $factory->build(63, 'F');

$temperature; //63 °F
$temperature->convert('C'); //17.2222222222 °C
$temperature->convert('C')->setPrecision(2); //17.22 °C
```

### Auto conversion
You can set Factory to autoconvert temperatures to given scale
```
use Temperature\Factory\DefaultFactory as TemperatureFactory;

$factory = new TemperatureFactory;
$factory->setAutoconvertTo('C');
$factory->getFormatter()->setPrecision(2);

$factory->build(100, 'F'); //37.78 °C
```

### Custom formatter
As default formatter is build by your locale settings. You can adjust it to your needs.
```
use Temperature\Formatter\StandardFormatter;

$formatter = new StandardFormatter();
$formatter->setDecimalSeperator(",");
$formatter->setPrecision(2);
$formatter->setShowSymbolMode(false);

$factory->setFormatter($formatter);

$factory->build(10.50, 'C'); //10,50
$factory->build(100, 'K'); //100
```
You can write your own Formatter. I must implemetnts FormatterInterface.

### Custom temperature scale
Assume you need new temperature scale. For purpose of this example let say C2 = 2 * Celsius
```
use \Temperature\Scales\Scale\AbstractScale;

class C2Scale extends AbstractScale
{
	const SYMBOL = "C2";

	/**
	 * @return float
	 */
	function getValueInCelsius()
	{
		return $this->value / 2;
	}

	/**
	 * @param $celsius
	 */
	function setValueInCelsius($celsius)
	{
		$this->value = $celsius * 2;
	}
}

$factory->getSupportedScales()->addSupportedType('C2', 'C2Scale');
$factory->build(100, 'C')->convert('C2'); //200 C2
$factory->build(50, 'K')->convert('C2'); //-446 C2
```

