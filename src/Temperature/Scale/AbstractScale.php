<?php
namespace Temperature\Scale;

use Temperature\Factory\DefaultFactory;
use Temperature\Formatter\StandardFormatter;

abstract class AbstractScale
{
	/**
	 * @var DefaultFactory
	 */
	private $factory;

	/**
	 * @var StandardFormatter
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
	 * @param StandardFormatter $formatter
	 */
	public function setFormatter(StandardFormatter $formatter)
	{
		$this->formatter = $formatter;
	}

	abstract function setValueInCelsius($celsius);

	abstract function getValueInCelsius();
}

