<?php

declare(strict_types=1);

namespace tests\MB;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\MBStringDTO;
use StringEncoder\MB\Regex;
use StringEncoder\Options;

class RegexTest extends TestCase
{
    /**
     * @var Regex
     */
    private $regex;

    protected function setUp(): void
    {
        $this->regex = new Regex;
    }

    public function test_replace()
    {
        $MBStringDTO = $this->regex->replace('[^A-Za-z0-9\.\-]', '',
            MBStringDTO::makeFromString(
                'my string!',
                new Options
            )
        );
        $this->assertEquals('mystring', $MBStringDTO->getString());
    }

    public function test_replace_ignore_case()
    {
        $MBStringDTO = $this->regex->replace('[^a-z0-9\.\-]', '',
            MBStringDTO::makeFromString(
                'My string!',
                new Options
            ), true);
        $this->assertEquals('Mystring', $MBStringDTO->getString());
    }

    public function test_replace_multiple()
    {
        $MBStringDTO = $this->regex->replaceMultiple([
            '[^A-Za-z0-9\.\-]',
            '[a-z0-9\.\-]',
        ], [
            '',
            'T',
        ],
            MBStringDTO::makeFromString(
                'My string!',
                new Options
            )
        );
        $this->assertEquals('MTTTTTTT', $MBStringDTO->getString());
    }

    public function test_set_encoding()
    {
        $this->regex->setEncoding('ASCII');
        $this->assertEquals('ASCII', $this->regex->getEncoding());
    }
}
