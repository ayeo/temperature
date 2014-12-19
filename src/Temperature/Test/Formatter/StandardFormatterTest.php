<?php
namespace Temperature\Test\Formatter;

use Temperature\Factory\DefaultFactory;

class StandardFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider testFormatMethodDataProvider
     */
    public function testFormatMethod($showSymbol, $value, $symbol, $precision, $expected)
    {
        $factory = new DefaultFactory();
        $factory->getFormatter()->setPrecision($precision);
        $factory->getFormatter()->setShowSymbolMode($showSymbol);
        $scale = $factory->build($value, $symbol);

        $this->assertEquals($expected, (string) $scale);

    }

    public function testFormatMethodDataProvider()
    {
        return [
            [true, 100, "K", 2, '100 K'],
            [true, 100.9191, "K", 2, '100.92 K'],
            [false, 100.9191, "K", 2, '100.92'],
            [false, 100.9191, "K", 1, '100.9'],
        ];
    }
}
 