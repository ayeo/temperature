Temperature
===========

Simple library to handle temperature scales

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

### Usage
```
use Temperature\Factory\DefaultFactory as TemperatureFactory;

$factory = new TemperatureFactory();
$temperature = $factory->build(63, 'F');

echo $temperature; //63 °F
echo $temperature->convert('C'); //17.2222222222 °C
echo $temperature->convert('C')->setPrecision(2); //17.22 °C
```

