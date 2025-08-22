<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\MB\Convert;

class ConvertNoEncodingTest extends TestCase
{
    /**
     * @var Convert
     */
    private $convert;

    protected function setUp(): void
    {
        $this->convert = new Convert;
    }

    public function test_to_string()
    {
        $string = $this->convert->fromString('my string')->toString();
        $this->assertEquals('my string', $string);
    }
}
