<?php

declare(strict_types=1);

namespace StringEncoder\MB;

use StringEncoder\Contracts\ConvertReadInterface;
use StringEncoder\Contracts\ConvertWriteInterface;
use StringEncoder\Contracts\DTO\EncodingDTOInterface;
use StringEncoder\Contracts\DTO\MBStringDTOInterface;
use StringEncoder\Contracts\OptionsInterface;
use StringEncoder\DTO\MBStringDTO;
use StringEncoder\Exceptions\ContentsFailedException;
use StringEncoder\Exceptions\ConvertNoValueException;
use StringEncoder\Exceptions\InvalidEncodingException;
use StringEncoder\MB\UTF8\Bom;
use StringEncoder\Options;

class Convert implements ConvertReadInterface, ConvertWriteInterface
{
    /**
     * @var ?EncodingDTOInterface
     */
    private $sourceEncoding;

    /**
     * @var EncodingDTOInterface
     */
    private $targetEncoding;

    /**
     * @var ?MBStringDTOInterface
     */
    private $mbStringDTO;

    /**
     * @var OptionsInterface
     */
    private $options;

    /**
     * @throws InvalidEncodingException
     */
    public function __construct(
        ?EncodingDTOInterface $sourceEncoding = null,
        ?EncodingDTOInterface $targetEncoding = null,
        ?OptionsInterface $options = null
    ) {
        if ($options === null) {
            $options = new Options;
        }
        $this->options = $options;

        if ($targetEncoding === null) {
            // apply default target encoding
            $targetEncoding = $this->options->getDefaultTargetEncoding();
        }

        $this->sourceEncoding = $sourceEncoding;
        $this->targetEncoding = $targetEncoding;
    }

    /**
     * @throws InvalidEncodingException
     */
    public function fromString(string $value): ConvertWriteInterface
    {
        $this->convert($value);

        return $this;
    }

    /**
     * @throws ConvertNoValueException
     */
    public function toString(): string
    {
        if ($this->mbStringDTO === null) {
            throw new ConvertNoValueException('No value set for call to convert to string.');
        }

        return $this->mbStringDTO->getString();
    }

    /**
     * @throws ContentsFailedException
     * @throws InvalidEncodingException
     */
    public function fromFile(string $filePath): ConvertWriteInterface
    {
        $content = @file_get_contents($filePath);
        if ($content === false) {
            throw new ContentsFailedException('file_get_contents failed and returned false when trying to read "' . $filePath . '".');
        }

        $this->convert($content);

        return $this;
    }

    /**
     * @throws ContentsFailedException
     * @throws ConvertNoValueException
     */
    public function toFile(string $filePath): void
    {
        if ($this->mbStringDTO === null) {
            throw new ConvertNoValueException('No value set for call to convert to string.');
        }

        $string = $this->mbStringDTO->getString();
        $status = @file_put_contents($filePath, $string);
        if ($status === false) {
            throw new ContentsFailedException('file_put_contents failed and returned false when trying to write "' . $filePath . '".');
        }
    }

    /**
     * @throws ConvertNoValueException
     */
    public function toDTO(): MBStringDTOInterface
    {
        if ($this->mbStringDTO === null) {
            throw new ConvertNoValueException('No value set for call to convert to string.');
        }

        return $this->mbStringDTO;
    }

    /**
     * @throws InvalidEncodingException
     */
    private function convert(string $value): void
    {
        if ($this->sourceEncoding === null) {
            $value = mb_convert_encoding($value, $this->targetEncoding->getEncoding());
        } elseif ($this->sourceEncoding->getEncoding() !== $this->targetEncoding->getEncoding()) {
            $value = mb_convert_encoding($value, $this->targetEncoding->getEncoding(), $this->sourceEncoding->getEncoding());
        }

        $this->mbStringDTO = MBStringDTO::makeFromString($value, $this->options, $this->targetEncoding);

        if ($this->options->isRemoveUTF8BOM() &&
            $this->targetEncoding->getEncoding() === 'UTF-8') {
            $bom = new Bom;
            $this->mbStringDTO = $bom->removeBOM($this->mbStringDTO);
        }
    }
}
