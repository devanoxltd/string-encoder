<?php

declare(strict_types=1);

namespace tests\DTO;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\Options;

class EncodingDTOTest extends TestCase
{
    public function test_make_from_string()
    {
        $encodingDTO = EncodingDTO::makeFromString('UTF-8');
        $this->assertEquals('UTF-8', $encodingDTO->getEncoding());
    }

    public function test_make_from_string_invalid()
    {
        $this->expectException(InvalidEncodingException::class);
        EncodingDTO::makeFromString('NOTANENCODING');
    }

    public function test_make_from_string_case_insensitive()
    {
        $encodingDTO = EncodingDTO::makeFromString('utf-8', null, (new Options)->setCaseSensitiveEncoding(false));
        $this->assertEquals('UTF-8', $encodingDTO->getEncoding());
    }
}
