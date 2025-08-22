<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\Exceptions\ConvertNoValueException;
use StringEncoder\MB\Convert;

class ConvertTest extends TestCase
{
    /**
     * @var Convert
     */
    private $convert;

    protected function setUp(): void
    {
        $this->convert = new Convert(
            EncodingDTO::makeFromString('ISO-8859-1'),
            EncodingDTO::makeFromString('UTF-8')
        );
    }

    public function test_to_string()
    {
        $string = $this->convert->fromString('my string')->toString();
        $this->assertEquals('my string', $string);
    }

    public function test_to_dto()
    {
        $dto = $this->convert->fromString('my string')->toDTO();
        $this->assertEquals('my string', $dto->getString());
    }

    public function test_to_string_without_from()
    {
        $this->expectException(ConvertNoValueException::class);
        $this->convert->toString();
    }

    public function test_to_dto_without_from()
    {
        $this->expectException(ConvertNoValueException::class);
        $this->convert->toDTO();
    }
}
