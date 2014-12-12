<?php
namespace Temperature\Scale;

class Celsius extends AbstractScale
{
	const SYMBOL = "°C";

	public function getValueInCelsius()
	{
		return $this->getValue();
	}

	public function setValueInCelsius($celsius)
	{
		$this->value =  $celsius;
	}
}