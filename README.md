Temperature
===========

Simple library to handle temperature scales

### Supported temperature scales
* Celsius
* Kelvin
* Farenheit

### Usage
```
use Temperature\Factory\DefaultFactory as TemperatureFactory;

$builder = new TemperatureBuilder();
$temperature = $builder->build(63, 'F');

echo $temperature; //63 °F
echo $temperature->convert('C'); //17.2222222222 °C
echo $temperature->convert('C')->setPrecision(2); //returns 17.22 °C
```
