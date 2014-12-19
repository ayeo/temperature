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
     * @var float
     */
    protected $value = 0;

    /**
     * @param null|float $value
     */
    public function __construct($value = null)
    {
        $this->value = (float) $value;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return (float) $this->value;
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        if ($this->shouldAddDegreeSignToSymbol()) {
            return sprintf('°%s', static::SYMBOL);
        } else {
            return $this->getRawSymbol();
        }
    }

    public function getRawSymbol()
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

    /**
     * @return bool
     */
    public function shouldAddDegreeSignToSymbol()
    {
        return true;
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
    abstract public function setValueInCelsius($celsius);

    /**
     * @return float
     */
    abstract public function getValueInCelsius();
}

