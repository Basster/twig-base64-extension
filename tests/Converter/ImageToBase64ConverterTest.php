<?php

declare(strict_types=1);

namespace Basster\TwigBase64\Tests\Converter;

use Basster\TwigBase64\Converter\FileConverterInterface;
use Basster\TwigBase64\Converter\ImageToBase64Converter;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class ImageToBase64ConverterTest.
 *
 * @covers \Basster\TwigBase64\Converter\ImageToBase64Converter
 */
final class ImageToBase64ConverterTest extends TestCase
{
    private $normalizer;

    private $converter;

    protected function setUp(): void
    {
        $this->normalizer = $this->prophesize(NormalizerInterface::class);
        $this->converter = new ImageToBase64Converter($this->normalizer->reveal());
        parent::setUp();
    }

    /**
     * @test
     */
    public function converterImplementsFileConverterInterface(): void
    {
        self::assertInstanceOf(FileConverterInterface::class, $this->converter);
    }

    /**
     * @test
     */
    public function convertCallsNormalizerWithSplFileObject(): void
    {
        $this->normalizer->normalize(Argument::which('getRealPath', __FILE__))
            ->shouldBeCalled()
            ->willReturn('data:image/gif,[...]');
        $this->converter->convert(__FILE__);
    }
}
