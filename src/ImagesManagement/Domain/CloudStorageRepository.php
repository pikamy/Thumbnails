<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain;

use Thumbnails\ImagesManagement\Domain\ValueObjects\Bucket;
use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;
use Thumbnails\ImagesManagement\Domain\ValueObjects\StorageName;
use Thumbnails\ImagesManagement\Domain\Exceptions\InvalidFileExtension;

interface CloudStorageRepository
{
    /**
     * @param FullPath $imagePath
     * @param Thumbnail $thumbnail
     * @param StorageName $storage
     * @param Bucket $bucket
     * @return void
     * @throws InvalidFileExtension
     */
    public function save(
        FullPath    $imagePath,
        Thumbnail   $thumbnail,
        StorageName $storage,
        Bucket      $bucket
    ): void;
}
