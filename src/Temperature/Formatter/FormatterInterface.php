<?php
namespace Temperature\Formatter;

interface FormatterInterface
{
	public function setPrecision($precision);

	public function setDecimalSeperator($decimalSeperator);

	public function setShowSymbolMode($mode);
}