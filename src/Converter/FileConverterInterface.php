<?php

declare(strict_types=1);

namespace Basster\TwigBase64\Converter;

/**
 * Class FileConverterInterface.
 */
interface FileConverterInterface
{
    public function convert(string $imagePath): string;
}
