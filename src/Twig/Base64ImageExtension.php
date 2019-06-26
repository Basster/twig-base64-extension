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
     * @var \Basster\TwigBase64\Converter\FileConverterInterface
     */
    private $fileConverter;

    /**
     * Base64ImageExtension constructor.
     */
    public function __construct(FileConverterInterface $fileConverter)
    {
        $this->fileConverter = $fileConverter;
    }

    public function getFilters(): array
    {
        return [
          new TwigFilter('image64', [$this, 'createBase64Image']),
        ];
    }

    public function createBase64Image(string $image): string
    {
        return $this->fileConverter->convert($image);
    }
}
