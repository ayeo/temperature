<?php
namespace Temperature\Factory;

use Temperature\Formatter\FormatterInterface;
use Temperature\Formatter\StandardFormatter;
use Temperature\Scales\Scale\AbstractScale;
use Temperature\Scales\SuppoertedScalesCollection;

class DefaultFactory
{
	/**
	 * @var FormatterInterface
	 */
	private $formatter;

	/**
	 * @var SuppoertedScalesCollection
	 */
	private $supportedScalesCollection;

	private $autoConvertTo = false;


	public function __construct()
	{
		$this->supportedScalesCollection = new SuppoertedScalesCollection();
		$this->formatter = $this->getDefaultFormatter();
	}

	/**
	 * @param $symbol
	 */
	public function setAutoconvertTo($symbol)
	{
		$this->supportedScalesCollection->get($symbol); //throws Exception
		$this->autoConvertTo = $symbol;
	}

	/**
	 * @param $value
	 * @param $symbol
	 * @return AbstractScale
	 * @throws \Exception
	 */
	public function build($value, $symbol)
	{
		$scale = $this->supportedScalesCollection->get($symbol, $value);
		$scale->setFactory($this);
		$scale->setFormatter($this->getFormatter());

		if ($this->autoConvertTo)
		{
			return $this->buildByScale($scale, $this->autoConvertTo);
		}

		return $scale;
	}

	/**
	 * @param AbstractScale $scale
	 * @param $symbol scale symbol
	 * @return AbstractScale
	 * @throws \Exception
	 */
	public function buildByScale(AbstractScale $scale, $symbol)
	{
		$newScale = $this->supportedScalesCollection->get($symbol);
		$newScale->setValueInCelsius($scale->getValueInCelsius());
		$newScale->setFactory($this);
		$newScale->setFormatter($this->getFormatter());

		return $newScale;
	}


	/**
	 * @param FormatterInterface $formatter
	 */
	public function setFormatter(FormatterInterface $formatter)
	{
		$this->formatter = $formatter;
	}

	/**
	 * @return FormatterInterface
	 */
	public function getFormatter()
	{
		return $this->formatter;
	}

	/**
	 * @return FormatterInterface
	 */
	private function getDefaultFormatter()
	{
		$locale = localeconv();
		$formatter = new StandardFormatter();
		$formatter->setDecimalSeperator($locale['decimal_point']);

		return $formatter;
	}

	public function getSupportedScales()
	{
		return $this->supportedScalesCollection;
	}
}