<?php

declare(strict_types=1);

namespace Basster\TwigBase64\Tests\Twig;

use Basster\TwigBase64\Converter\FileConverterInterface;
use Basster\TwigBase64\Twig\Base64ImageExtension;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Twig\TwigFilter;

/**
 * Class Base64ImageExtensionTest.
 *
 * @covers \Basster\TwigBase64\Twig\Base64ImageExtension
 */
final class Base64ImageExtensionTest extends TestCase
{
    use ProphecyTrait;

    private const BASE64_AVATAR = 'data:image/gif;base64,R0lGODdhAQABAIAAAP///////ywAAAAAAQABAAACAkQBADs=';
    private const AVATAR = 'avatar.gif';

    private FileConverterInterface | ObjectProphecy $converter;

    private Base64ImageExtension $extension;

    protected function setUp(): void
    {
        $this->converter = $this->prophesize(FileConverterInterface::class);
        $this->extension = new Base64ImageExtension($this->converter->reveal());
        parent::setUp();
    }

    /**
     * @test
     */
    public function hasImage64Filter(): void
    {
        self::assertSame('image64', $this->getFirstFilter()->getName());
    }

    /**
     * @test
     */
    public function createBase64ImageCallsConvertFunction(): void
    {
        $this->converter->convert(self::AVATAR)->willReturn(self::BASE64_AVATAR);
        $this->extension->createBase64Image(self::AVATAR);
        $this->converter->convert(self::AVATAR)->shouldHaveBeenCalled();
    }

    /**
     * @test
     */
    public function filterFunctionIsCreateBase64Image(): void
    {
        $filter = $this->getFirstFilter();
        self::assertSame('createBase64Image', $filter->getCallable()[1]);
    }

    /**
     * @test
     */
    public function filterFunctionCallerIsTheExtension(): void
    {
        $filter = $this->getFirstFilter();
        self::assertSame($this->extension, $filter->getCallable()[0]);
    }

    private function getFirstFilter(): TwigFilter
    {
        $filters = $this->extension->getFilters();

        return $filters[0];
    }
}
