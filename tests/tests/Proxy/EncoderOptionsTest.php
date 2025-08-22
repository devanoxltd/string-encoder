<?php

declare(strict_types=1);

namespace tests\Proxy;

use PHPUnit\Framework\TestCase;
use StringEncoder\Options;
use StringEncoder\Proxy\Encoder;

class EncoderOptionsTest extends TestCase
{
    /**
     * @var Options
     */
    private $options;

    protected function setUp(): void
    {
        $this->options = new Options;
        Encoder::mount('Encoder', new \StringEncoder\Encoder);
    }

    protected function tearDown(): void
    {
        Encoder::unload();
    }

    public function test_set_options()
    {
        \Encoder::setOptions($this->options);
        $this->assertNull(\Encoder::getTargetEncoding());
    }
}
