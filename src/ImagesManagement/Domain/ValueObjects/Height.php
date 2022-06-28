<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\ValueObjects;

use Thumbnails\ImagesManagement\Domain\Exceptions\SideTooSmall;

class Height extends Side
{
    public static function create(int $height): self
    {
        if (self::isSizeTooSmall($height)) {
            throw SideTooSmall::create('HEIGHT');
        }

        return new self($height);
    }
}
