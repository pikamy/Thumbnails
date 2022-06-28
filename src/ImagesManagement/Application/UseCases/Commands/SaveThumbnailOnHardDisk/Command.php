<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnHardDisk;

use Thumbnails\ImagesManagement\Domain\ValueObjects\Width;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Height;
use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;
use Thumbnails\ImagesManagement\Application\UseCases\BaseCommand;

class Command implements BaseCommand
{
    private FullPath $imagePath;
    private FullPath $thumbnailPath;
    private Height $height;
    private Width $width;

    public function __construct(
        FullPath $imagePath,
        FullPath $thumbnailPath,
        Height $height,
        Width  $width
    ) {
        $this->imagePath = $imagePath;
        $this->thumbnailPath = $thumbnailPath;
        $this->height = $height;
        $this->width = $width;
    }

    public function imagePath(): FullPath
    {
        return $this->imagePath;
    }

    public function thumbnailPath(): FullPath
    {
        return $this->thumbnailPath;
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
