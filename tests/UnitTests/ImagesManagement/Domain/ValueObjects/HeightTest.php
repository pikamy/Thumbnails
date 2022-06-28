<?php

declare(strict_types=1);

namespace Thumbnails\Tests\UnitTests\ImagesManagement\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Height;
use Thumbnails\ImagesManagement\Domain\Exceptions\SideTooSmall;

class HeightTest extends TestCase
{
    private const SIDE_MIN_SIZE = 1;

    public function testCreate_GivenHeightIsTooSmall_ThrowsException(): void
    {
        // arrange
        $tooSmallHeightAsInt = self::SIDE_MIN_SIZE - 1;

        // assert
        self::expectExceptionObject(SideTooSmall::create('HEIGHT'));

        // act
        Height::create($tooSmallHeightAsInt);
    }
}
