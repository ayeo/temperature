<?php
namespace Temperature\Scales;

use Temperature\Scales\Scale\AbstractScale;

class SuppoertedScalesCollection
{
    private $supportedTypes = [
        'K'  => 'Temperature\Scales\Scale\Kelvin',
        'C'  => 'Temperature\Scales\Scale\Celsius',
        'F'  => 'Temperature\Scales\Scale\Farenheit',
        'R'  => 'Temperature\Scales\Scale\Rankine',
        'Re' => 'Temperature\Scales\Scale\Reaumur',
    ];

    /**
     * TODO: check if inherits AbstractScale!
     *
     * @param $symbol scale symbol (e.g. K or C)
     * @param $className class name must exists
     * @throws \Exception
     */
    public function addSupportedType($symbol, $className)
    {
        $classExists = class_exists($className);
        $reflection = new \ReflectionClass($className);
        $classIsValid = $reflection->getParentClass()->name === 'Temperature\Scales\Scale\AbstractScale';

        if ($classExists && $classIsValid) {
            $this->supportedTypes[$symbol] = $className;
        } else {
            throw new \Exception('Given class name does NOT exists or does not extends AbstractScale');
        }

    }

    /**
     * @param string $symbol
     * @param null|float $value
     * @return AbstractScale
     * @throws \Exception
     */
    public function get($symbol, $value = null)
    {
        if (array_key_exists($symbol, $this->supportedTypes)) {
            $className = $this->supportedTypes[$symbol];

            return new $className((double) $value);
        }

        throw new \Exception('Invalid temperature scale symbol');
    }
}