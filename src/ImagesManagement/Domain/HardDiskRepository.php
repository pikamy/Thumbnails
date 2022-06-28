<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain;

use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;
use Thumbnails\ImagesManagement\Domain\Exceptions\FileNotFound;
use Thumbnails\ImagesManagement\Domain\Exceptions\InvalidFileExtension;

interface HardDiskRepository
{
    /**
     * @param FullPath $fullPath
     * @return Image
     * @throws FileNotFound
     */
    public function getImageFromPath(FullPath $fullPath): Image;

    /**
     * @param FullPath $imagePath
     * @param Thumbnail $thumbnail
     * @param FullPath $thumbnailPath
     * @return void
     * @throws InvalidFileExtension
     */
    public function save(FullPath $imagePath, Thumbnail $thumbnail, FullPath $thumbnailPath): void;
}
