<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain;

use Thumbnails\ImagesManagement\Domain\ValueObjects\Width;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Height;

class Image
{
    private Height $height;
    private Width $width;

    protected function __construct(Height $height, Width $width) {
        $this->height = $height;
        $this->width = $width;
    }

    public static function create(Height $height, Width $width): self {
        return new self($height, $width);
    }

    public static function recreate(Height $height, Width $width): self {
        return new self($height, $width);
    }

    public function convertToThumbnail(Height $height, Width $width): Thumbnail {

        return Thumbnail::create($height, $width);
    }

    public function height(): Height
    {
        return $this->height;
    }

    public function width(): Width
    {
        return $this->width;
    }
}

