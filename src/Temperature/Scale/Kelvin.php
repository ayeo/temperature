<?php
namespace Temperature\Scale;

class Kelvin extends AbstractScale
{
	const SYMBOL = 'K';

	public function getValueInCelsius()
	{
		return $this->getValue() - 273.15;
	}

	public function setValueInCelsius($celsius)
	{
		$this->value = $celsius + 273.15;
	}

}