<?php
namespace Temperature\Factory;

use Temperature\Formatter\StandardFormatter;
use Temperature\Scale\AbstractScale;

class DefaultFactory
{
	private $formatter;

	private $supportedTypes = array
	(
		'K' => 'Temperature\Scale\Kelvin',
		'C' => 'Temperature\Scale\Celsius',
		'F' => 'Temperature\Scale\Farenheit'
	);

	public function build($value, $symbol)
	{
		if (isset($this->supportedTypes[$symbol]))
		{
			$classname = $this->supportedTypes[$symbol];
			$scale = new $classname($value);
			$scale->setFactory($this);
			$scale->setFormatter($this->getFormatter());

			return $scale;
		}

		throw new Exception('Invalid temperature scale symbol');
	}

	/**
	 * @param AbstractScale $scale
	 * @param $symbol scale symbol
	 * @return AbstractScale
	 * @throws \Exception
	 */
	public function buildByScale(AbstractScale $scale, $symbol)
	{
		if (isset($this->supportedTypes[$symbol]))
		{
			$newScale = $this->build(null, $symbol);
			$newScale->setValueInCelsius($scale->getValueInCelsius());

			return $newScale;
		}

		throw new \Exception('Invalid temperature scale symbol');
	}

	/**
	 * @param $symbol scale symbol (e.g. K or C)
	 * @param $className class name must exists
	 * @throws \Exception
	 */
	public function addSupportedType($symbol, $className)
	{
		if (class_exists($className))
		{
			$this->supportedTypes[$symbol] = $className;
		}

		throw new \Exception('Given class name does NOT exists');
	}

	/**
	 * @param StandardFormatter $formatter
	 */
	public function setFormatter(StandardFormatter $formatter)
	{
		$this->formatter = $formatter;
	}

	/**
	 * @return StandardFormatter
	 */
	private function getFormatter()
	{
		if (is_null($this->formatter))
		{
			return $this->getDefaultFormatter();
		}

		return $this->formatter;
	}

	/**
	 * @return StandardFormatter
	 */
	private function getDefaultFormatter()
	{
		$locale = localeconv();
		$formatter = new StandardFormatter();
		$formatter->setDecimalSeperator($locale['decimal_point']);

		return $formatter;
	}
}