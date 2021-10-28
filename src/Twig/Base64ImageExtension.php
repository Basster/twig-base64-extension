<?php

declare(strict_types=1);

namespace Basster\TwigBase64\Twig;

use Basster\TwigBase64\Converter\FileConverterInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class Base64ImageExtension.
 */
final class Base64ImageExtension extends AbstractExtension
{
    /**
     * Base64ImageExtension constructor.
     */
    public function __construct(private FileConverterInterface $fileConverter)
    {
    }

    public function getFilters(): array
    {
        return [
          new TwigFilter('image64', [$this, 'createBase64Image']),
        ];
    }

    public function createBase64Image(string $image): string
    {
        return $this->fileConverter->convert($_SERVER['DOCUMENT_ROOT'] . $image);
    }
}
