<?php
namespace Temperature\Scales\Scale;

class Celsius extends AbstractScale
{
    const SYMBOL = "C";

    public function getValueInCelsius()
    {
        return (float) $this->getValue();
    }

    public function setValueInCelsius($celsius)
    {
        $this->value = (float) $celsius;
    }
}