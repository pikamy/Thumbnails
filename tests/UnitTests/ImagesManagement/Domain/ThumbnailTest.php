<?php

declare(strict_types=1);

namespace Thumbnails\Tests\UnitTests\ImagesManagement\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use Thumbnails\ImagesManagement\Domain\Thumbnail;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Width;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Height;
use Thumbnails\ImagesManagement\Domain\Exceptions\LongerSideTooBig;

class ThumbnailTest extends TestCase
{
    private const SIDE_MIN_SIZE = 1;
    private const SIDE_MAX_SIZE = 150;

    /**
     * @dataProvider provideValidSides
     * @param Height $validHeight
     * @param Width $validWidth
     */
    public function testCreate_ThumbnailHasBeenCreatedWithSpecificParameters_ExpectedParametersAreSet(
        Height $validHeight,
        Width $validWidth
    ): void {
        // arrange

        // act
        $thumbnail = Thumbnail::create($validHeight, $validWidth);

        // assert
        self::assertEquals($validHeight, $thumbnail->height());
        self::assertEquals($validWidth, $thumbnail->width());
    }

    public function provideValidSides(): array
    {
        return [
            [Height::create(self::SIDE_MIN_SIZE), Width::create(self::SIDE_MIN_SIZE)],
            [Height::create(self::SIDE_MAX_SIZE), Width::create(self::SIDE_MAX_SIZE)]
        ];
    }

    /**
     * @dataProvider provideTooBigSides
     * @param Height $validHeight
     * @param Width $validWidth
     */
    public function testCreate_GivenLongerSideIsTooBig_ThrowsException(
        Height $height,
        Width $width
    ): void {
        // arrange

        // assert
        self::expectExceptionObject(LongerSideTooBig::create());

        // act
        Thumbnail::create($height, $width);
    }

    public function provideTooBigSides(): array
    {
        return [
            [Height::create(self::SIDE_MAX_SIZE), Width::create(self::SIDE_MAX_SIZE + 1)],
            [Height::create(self::SIDE_MAX_SIZE + 1), Width::create(self::SIDE_MAX_SIZE)]
        ];
    }
}
