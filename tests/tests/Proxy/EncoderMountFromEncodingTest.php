<?php

declare(strict_types=1);

namespace tests\Proxy;

use PHPUnit\Framework\TestCase;
use StringEncoder\Proxy\Encoder;

class EncoderMountFromEncodingTest extends TestCase
{
    protected function setUp(): void
    {
        Encoder::mountFromEncoding('ISO-8859-1', 'UTF-8');
    }

    protected function tearDown(): void
    {
        Encoder::unload();
    }

    public function test_convert()
    {
        $string = Encoder::convert()->fromString('my string')->toString();
        $this->assertEquals('my string', $string);
    }

    public function test_get_mounted_encoder()
    {
        $encoder = Encoder::getMountedEncoder();
        $this->assertTrue($encoder instanceof \StringEncoder\Encoder);
    }
}
