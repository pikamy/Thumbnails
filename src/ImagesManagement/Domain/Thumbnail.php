<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain;

use Thumbnails\ImagesManagement\Domain\ValueObjects\Side;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Width;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Height;
use Thumbnails\ImagesManagement\Domain\Exceptions\LongerSideTooBig;

class Thumbnail extends Image
{
    private const LONGER_SIDE_MAX_SIZE = 150;

    public static function create(Height $height, Width $width): self {
        $longerSide = $height->isGreaterThan($width) ? $height : $width;
        self::validateSize($longerSide);

        return new self($height, $width);
    }

    /**
     * @param Height $height
     * @return void
     * @throws LongerSideTooBig
     */
    private static function validateSize(Side $side): void
    {
        if ($side->isGreaterThan(Height::create(self::LONGER_SIDE_MAX_SIZE))) {
            throw LongerSideTooBig::create();
        }
    }
}
