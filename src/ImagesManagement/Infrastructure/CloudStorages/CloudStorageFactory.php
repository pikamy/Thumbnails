<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Infrastructure\CloudStorages;

use Thumbnails\ImagesManagement\Domain\ValueObjects\StorageName;
use Thumbnails\ImagesManagement\Domain\Exceptions\StorageNotFound;

class CloudStorageFactory
{
    /**
     * @param StorageName $storageName
     * @return CloudStorage
     * @throws StorageNotFound
     */
    public static function createFromStorageName(StorageName $storageName): CloudStorage
    {
        switch ((string)$storageName) {
            case 'aws':
                return Aws::create();
            default:
                throw StorageNotFound::create();
        }
    }
}
