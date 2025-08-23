<?php

declare(strict_types=1);

namespace StringEncoder\MB;

use StringEncoder\Contracts\DTO\EncodingDTOInterface;

class Validator
{
    /**
     * @internal
     */
    public function validateEncoding(string $encoding, bool $caseSensitive): bool
    {
        return $this->determineEncoding($encoding, $caseSensitive) !== null;
    }

    /**
     * @internal
     */
    public function determineEncoding(string $encoding, bool $caseSensitive): ?string
    {
        $encodingList = mb_list_encodings();
        $inputEncoding = $caseSensitive ? $encoding : mb_convert_case($encoding, MB_CASE_LOWER);

        foreach ($encodingList as $validEncoding) {
            $compareEncoding = $caseSensitive ? $validEncoding : mb_convert_case($validEncoding, MB_CASE_LOWER);

            if ($compareEncoding === $inputEncoding) {
                return $validEncoding;
            }
        }

        return null;
    }

    public function validateString(string $string, EncodingDTOInterface $encodingDTO): bool
    {
        $expectedEncoding = $encodingDTO->getEncoding();
        $encoding = mb_detect_encoding($string, [$expectedEncoding]);
        if ($expectedEncoding === 'ASCII') {
            // Check for any non-ASCII character
            if (preg_match('/[^\x00-\x7F]/', $string)) {
                return false;
            }
        }

        return $encoding === $expectedEncoding;
    }
}
