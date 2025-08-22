<?php

declare(strict_types=1);

namespace tests\DTO;

use PHPUnit\Framework\TestCase;
use StringEncoder\Contracts\DTO\EncodingDTOInterface;
use StringEncoder\Contracts\OptionsInterface;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\DTO\MBStringDTO;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\Options;

class MBStringDTOTest extends TestCase
{
    /**
     * @var \StringEncoder\Contracts\DTO\MBStringDTOInterface
     */
    private $mbStringDTO;

    protected function setUp(): void
    {
        $this->mbStringDTO = MBStringDTO::makeFromString('test string', new Options);
    }

    public function test_make_from_string()
    {
        $this->assertEquals('test string', $this->mbStringDTO->getString());
    }

    public function test_get_options()
    {
        $this->assertTrue($this->mbStringDTO->getOptions() instanceof OptionsInterface);
    }

    public function test_get_encoding_dto()
    {
        $this->assertTrue($this->mbStringDTO->getEncodingDTO() instanceof EncodingDTOInterface);
    }

    public function test_wrong_encoding()
    {
        $this->expectException(InvalidEncodingException::class);
        MBStringDTO::makeFromString('ひらがな', new Options, EncodingDTO::makeFromString('ASCII'));
    }
}
