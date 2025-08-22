<?php

declare(strict_types=1);

namespace tests\MB\UTF8;

use PHPUnit\Framework\TestCase;
use StringEncoder\DTO\MBStringDTO;
use StringEncoder\MB\UTF8\Bom;
use StringEncoder\Options;

class BomTest extends TestCase
{
    /**
     * @var Bom
     */
    private $bom;

    protected function setUp(): void
    {
        $this->bom = new Bom;
    }

    public function test_remove_bom()
    {
        $this->assertEquals(
            'this is a string',
            $this->bom->removeBOM(
                MBStringDTO::makeFromString("\xef\xbb\xbfthis is a string", new Options)
            )->getString()
        );
    }

    public function test_remove_bom_from_end_of_string()
    {
        $this->assertEquals(
            'this is a string',
            $this->bom->removeBOM(
                MBStringDTO::makeFromString("this is a string\xef\xbb\xbf", new Options)
            )->getString()
        );
    }
}
