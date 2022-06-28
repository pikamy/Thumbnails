<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\ValueObjects;

use Thumbnails\ImagesManagement\Domain\Exceptions\SideTooSmall;

class Width extends Side
{
    public static function create(int $width): self
    {
        if (self::isSizeTooSmall($width)) {
            throw SideTooSmall::create('WIDTH');
        }

        return new self($width);
    }
}
