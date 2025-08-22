<?php

declare(strict_types=1);

namespace tests;

use PHPUnit\Framework\TestCase;
use StringEncoder\Encoder;
use StringEncoder\Options;

class OptionsTest extends TestCase
{
    private $encoder;
    /**
     * @var Options
     */
    private $options;

    protected function setUp(): void
    {
        $this->encoder = new Encoder;
        $this->options = new Options;
    }

    public function test_set_options()
    {
        $this->options->setDefaultTargetEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $this->options->getDefaultTargetEncoding()->getEncoding());
    }

    public function test_set_options_in_encoder()
    {
        $this->options->setDefaultTargetEncoding('ISO-8859-1');
        $this->encoder->setOptions($this->options);
        $this->assertNull($this->encoder->getTargetEncoding());
    }

    public function test_set_default_target_encoding()
    {
        $this->options->setDefaultTargetEncoding('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $this->options->getDefaultTargetEncoding()->getEncoding());
    }

    public function test_set_default_target_options_encoding()
    {
        $this->options->setCaseSensitiveEncoding(false);
        $this->options->setDefaultTargetEncoding('iso-8859-1');
        $this->assertEquals('ISO-8859-1', $this->options->getDefaultTargetEncoding()->getEncoding());
    }

    public function test_set_remove_ut_f8_bom()
    {
        $this->options->setRemoveUTF8BOM(true);
        $this->assertTrue($this->options->isRemoveUTF8BOM());
    }

    public function test_set_case_sensitive_encoding()
    {
        $this->options->setCaseSensitiveEncoding(false);
        $this->assertFalse($this->options->isCaseSensitiveEncoding());
    }
}
