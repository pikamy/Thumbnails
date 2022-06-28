<?php

declare(strict_types=1);

namespace Thumbnails\Tests\UnitTests\ImagesManagement\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Width;
use Thumbnails\ImagesManagement\Domain\Exceptions\SideTooSmall;

class WidthTest extends TestCase
{
    private const SIDE_MIN_SIZE = 1;

    public function testCreate_GivenWidthIsTooSmall_ThrowsException(): void
    {
        // arrange
        $tooSmallWidthAsInt = self::SIDE_MIN_SIZE - 1;

        // assert
        self::expectExceptionObject(SideTooSmall::create('WIDTH'));

        // act
        Width::create($tooSmallWidthAsInt);
    }
}
