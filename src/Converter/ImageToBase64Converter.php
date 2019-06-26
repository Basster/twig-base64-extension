<?php

declare(strict_types=1);

namespace Basster\TwigBase64\Converter;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class ImageToBase64Converter.
 */
final class ImageToBase64Converter implements FileConverterInterface
{
    /**
     * @var \Symfony\Component\Serializer\Normalizer\NormalizerInterface
     */
    private $normalizer;

    /**
     * ImageToBase64Converter constructor.
     */
    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function convert(string $imagePath): string
    {
        return $this->normalizer->normalize(new \SplFileObject($imagePath));
    }
}
