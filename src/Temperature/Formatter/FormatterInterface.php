<?php
namespace Temperature\Formatter;

interface FormatterInterface
{
    /**
     * @return void
     */
    public function setPrecision($precision);

    /**
     * @return void
     */
    public function setDecimalSeperator($decimalSeperator);

    /**
     * @return void
     */
    public function setShowSymbolMode($mode);
}