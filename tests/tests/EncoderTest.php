<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use StringEncoder\Encoder;

class EncoderTest extends TestCase
{
    private $encoder;

    protected function setUp(): void
    {
        $this->encoder = new Encoder;
    }

    public function test_set_source()
    {
        $this->encoder->setSourceEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $this->encoder->getSourceEncoding());
    }

    public function test_set_target()
    {
        $this->encoder->setTargetEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $this->encoder->getTargetEncoding());
    }

    public function test_convert()
    {
        $this->encoder->setSourceEncoding('ISO-8859-1');
        $this->encoder->setTargetEncoding('UTF-8');
        $string = $this->encoder->convert()->fromString('my string')->toString();
        $this->assertEquals('my string', $string);
    }

    public function test_get_source_without_setting()
    {
        $this->assertNull($this->encoder->getSourceEncoding());
    }
}
