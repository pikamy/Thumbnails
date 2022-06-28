<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnCloud;

use Thumbnails\ImagesManagement\Domain\ValueObjects\Width;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Bucket;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Height;
use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;
use Thumbnails\ImagesManagement\Domain\ValueObjects\StorageName;
use Thumbnails\ImagesManagement\Application\UseCases\BaseCommand;

class Command implements BaseCommand
{
    private FullPath $imagePath;
    private Height $height;
    private Width $width;
    private Bucket $bucket;
    private StorageName $storageName;

    public function __construct(
        FullPath $imagePath,
        Height $height,
        Width  $width,
        Bucket $bucket,
        StorageName $storageName
    ) {
        $this->imagePath = $imagePath;
        $this->height = $height;
        $this->width = $width;
        $this->bucket = $bucket;
        $this->storageName = $storageName;
    }

    public function imagePath(): FullPath
    {
        return $this->imagePath;
    }

    public function height(): Height
    {
        return $this->height;
    }

    public function width(): Width
    {
        return $this->width;
    }

    public function bucket(): Bucket
    {
        return $this->bucket;
    }

    public function storageName(): StorageName
    {
        return $this->storageName;
    }
}
