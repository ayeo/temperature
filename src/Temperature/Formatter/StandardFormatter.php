<?php
namespace Temperature\Formatter;

use Temperature\Scale\AbstractScale;

class StandardFormatter
{
	private $precise = null;

	private $decimalSeperator = ".";

	public function setPrecision($precision)
	{
		$this->precise = $precision;
	}

	public function setDecimalSeperator($decimalSeperator)
	{
		$this->decimalSeperator = $decimalSeperator;
	}

	public function format(AbstractScale $scale)
	{
		return sprintf("%s %s", $this->getValue($scale), $scale->getSymbol());
	}

	private function getValue(AbstractScale $scale)
	{
		if (is_null($this->precise))
		{
			return $scale->getValue();
		}

		return round($scale->getValue(), $this->precise);
	}
}