<?php
namespace Temperature\Scale;

class Farenheit extends AbstractScale
{
	const SYMBOL = "°F";

	public function getValueInCelsius()
	{
		return (float) 5 / 9 * ($this->getValue() - 32);
	}

	public function setValueInCelsius($celsius)
	{
		$this->value = (float) 32 + 9 / 5 * $celsius;
	}

}