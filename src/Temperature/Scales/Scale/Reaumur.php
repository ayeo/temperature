<?php
namespace Temperature\Scales\Scale;

class Reaumur extends AbstractScale
{
    const SYMBOL = "Ré";

    public function getValueInCelsius()
    {
        return (float) $this->getValue() * 1.25;
    }

    public function setValueInCelsius($celsius)
    {
        $this->value = (float) $celsius * 4 / 5;
    }
}