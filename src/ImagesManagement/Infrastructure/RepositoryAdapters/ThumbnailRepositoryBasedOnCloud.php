<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Infrastructure\RepositoryAdapters;

use Thumbnails\ImagesManagement\Domain\Thumbnail;
use Thumbnails\ImagesManagement\Domain\HardDiskRepository;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Bucket;
use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;
use Thumbnails\ImagesManagement\Domain\CloudStorageRepository;
use Thumbnails\ImagesManagement\Domain\ValueObjects\StorageName;
use Thumbnails\ImagesManagement\Infrastructure\CloudStorages\CloudStorageFactory;

class ThumbnailRepositoryBasedOnCloud implements CloudStorageRepository
{
    private HardDiskRepository $hardDiskRepository;

    public function __construct(HardDiskRepository $hardDiskRepository)
    {
        $this->hardDiskRepository = $hardDiskRepository;
    }

    public function save(
        FullPath $imagePath,
        Thumbnail $thumbnail,
        StorageName $storage,
        Bucket $bucket
    ): void {
        $tmpFilePath = $this->createTmpPath($imagePath);
        $this->hardDiskRepository->save($imagePath, $thumbnail, $tmpFilePath);
        $cloudStorageClient = CloudStorageFactory::createFromStorageName($storage);
        $cloudStorageClient->upload($tmpFilePath, $bucket);
        unlink((string)$tmpFilePath);
    }

    private function createTmpPath(FullPath $path): FullPath
    {
        return FullPath::create(str_replace('.', '_tmp.', $path));
    }
}
