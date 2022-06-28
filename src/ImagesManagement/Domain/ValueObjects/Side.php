<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\ValueObjects;

abstract class Side
{
    private const SIDE_MIN_SIZE = 1;
    private int $value;

    protected function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function isGreaterThan(Side $side): bool
    {
        return $this->value > $side->value();
    }

    protected static function isSizeTooSmall(int $size): bool
    {
        return $size < self::SIDE_MIN_SIZE;
    }
}
