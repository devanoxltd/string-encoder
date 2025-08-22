<?php

declare(strict_types=1);

namespace tests\Proxy;

use PHPUnit\Framework\TestCase;
use StringEncoder\Proxy\Encoder;

class EncoderTest extends TestCase
{
    protected function setUp(): void
    {
        Encoder::mount('Encoder', new \StringEncoder\Encoder);
    }

    protected function tearDown(): void
    {
        Encoder::unload();
    }

    public function test_set_source()
    {
        \Encoder::setSourceEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', \Encoder::getSourceEncoding());
    }

    public function test_set_target()
    {
        \Encoder::setTargetEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', \Encoder::getTargetEncoding());
    }
}
