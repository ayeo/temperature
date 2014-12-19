<?php
namespace Temperature\Scales\Scale;

use Temperature\Factory\DefaultFactory;
use Temperature\Formatter\FormatterInterface;

abstract class AbstractScale
{
    /**
     * @var DefaultFactory
     */
    private $factory;

    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @var null|float
     */
    protected $value = null;

    /**
     * @param null|float $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return float|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return static::SYMBOL;
    }

    /**
     * @param $symbol
     * @return AbstractScale
     */
    public function convert($symbol)
    {
        return $this->factory->buildByScale($this, $symbol);
    }


    public function __toString()
    {
        return $this->formatter->format($this);
    }

    public function setPrecision($precision)
    {
        $this->formatter = clone($this->factory->getFormatter());
        $this->formatter->setPrecision($precision);

        return $this;
    }

    /**
     * @param DefaultFactory $factory
     */
    public function setFactory(DefaultFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param FormatterInterface $formatter
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @param double $celsius
     */
    abstract function setValueInCelsius($celsius);

    /**
     * @return float
     */
    abstract function getValueInCelsius();
}

