<?php
namespace Temperature\Scale;

class Rankine extends AbstractScale
{
	const SYMBOL = "°R";

	public function getValueInCelsius()
	{
		return (float) $this->getValue() / 1.8 - 273.15;
 	}

	public function setValueInCelsius($celsius)
	{
		$this->value = (float) ($celsius + 273.15) * 1.8;
	}

}