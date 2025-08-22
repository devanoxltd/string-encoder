<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\EncodingDTO;
use StringEncoder\Exceptions\ContentsFailedException;
use StringEncoder\Exceptions\ConvertNoValueException;
use StringEncoder\MB\Convert;

use function unlink;

class ConvertFileTest extends TestCase
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

    public function test_from_file()
    {
        $string = $this->convert->fromFile('./tests/data/data.txt')->toString();
        $this->assertEquals('this is a random string, so random it is the most random string.', $string);
    }

    public function test_from_file_not_found()
    {
        $this->expectException(ContentsFailedException::class);
        $this->convert->fromFile('./path/not/fount.txt');
    }

    public function test_to_file()
    {
        $this->convert->fromFile('./tests/data/data.txt')->toFile('./tests/data/test.data.txt');
        $string = $this->convert->fromFile('./tests/data/test.data.txt')->toString();
        unlink('./tests/data/test.data.txt');
        $this->assertEquals('this is a random string, so random it is the most random string.', $string);
    }

    public function test_to_file_no_from()
    {
        $this->expectException(ConvertNoValueException::class);
        $this->convert->toFile('./tests/data/test.data.txt');
    }

    public function test_to_file_directory()
    {
        $this->expectException(ContentsFailedException::class);
        $this->convert->fromFile('./tests/data/data.txt')->toFile('./tests');
    }
}
