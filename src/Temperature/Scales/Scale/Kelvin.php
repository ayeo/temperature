<?php
namespace Temperature\Scales\Scale;

class Kelvin extends AbstractScale
{
    const SYMBOL = 'K';

    public function getValueInCelsius()
    {
        return (float) $this->getValue() - 273.15;
    }

    public function setValueInCelsius($celsius)
    {
        $this->value = (float) $celsius + 273.15;
    }

    /**
     * @return bool
     */
    public function shouldAddDegreeSignToSymbol()
    {
        return false;
    }

}