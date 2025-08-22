<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\MB\Validator;

class ValidatorTest extends TestCase
{
    /**
     * @var Validator
     */
    private $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator;
    }

    public function test_validate_encoding()
    {
        $this->assertTrue($this->validator->validateEncoding('UTF-8', true));
    }

    public function test_validate_encoding_case_insensitive()
    {
        $this->assertTrue($this->validator->validateEncoding('utf-8', false));
    }

    public function test_validate_encoding_invalid()
    {
        $this->assertFalse($this->validator->validateEncoding('NOTANENCODING', true));
    }

    public function test_validate_encoding_invali_case()
    {
        $this->assertFalse($this->validator->validateEncoding('utf-8', true));
    }

    public function test_validate_encoding_alias()
    {
        $this->assertTrue($this->validator->validateEncoding('US-ASCII', true));
    }

    public function test_validate_encoding_alias_case_insensitive()
    {
        $this->assertTrue($this->validator->validateEncoding('us-ascII', false));
    }
}
