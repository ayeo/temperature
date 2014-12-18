<?php
namespace Temperature\Formatter;

use Temperature\Scales\Scale\AbstractScale;

class StandardFormatter implements FormatterInterface
{
    private $precise = null;

    private $decimalSeperator = ".";

    private $showSymbol = true;

    public function setShowSymbolMode($mode)
    {
        $this->showSymbol = $mode;
    }

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
        if ($this->showSymbol)
        {
            return sprintf("%s %s", $this->getValue($scale), $scale->getSymbol());
        }

        return (string)$this->getValue($scale);
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