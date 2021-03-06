<?php

declare(strict_types=1);

namespace Basster\TwigBase64\Converter;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class ImageToBase64Converter.
 */
final class ImageToBase64Converter implements FileConverterInterface
{
    /**
     * ImageToBase64Converter constructor.
     */
    public function __construct(private NormalizerInterface $normalizer)
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function convert(string $imagePath): string
    {
        return (string) $this->normalizer->normalize(new \SplFileObject($imagePath));
    }
}
