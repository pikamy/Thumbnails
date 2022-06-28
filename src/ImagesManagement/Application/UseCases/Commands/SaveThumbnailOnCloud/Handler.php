<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnCloud;

use Thumbnails\ImagesManagement\Domain\HardDiskRepository;
use Thumbnails\ImagesManagement\Domain\CloudStorageRepository;
use Thumbnails\ImagesManagement\Domain\Exceptions\ValidationProblem;

class Handler
{
    private CloudStorageRepository $cloudStorageRepository;
    private HardDiskRepository $hardDiskRepository;

    public function __construct(CloudStorageRepository $cloudStorageRepository, HardDiskRepository $repository) {
        $this->cloudStorageRepository = $cloudStorageRepository;
        $this->hardDiskRepository = $repository;
    }

    /**
     * @param Command $command
     * @return void
     * @throws ValidationProblem
     */
    public function handle(Command $command): void
    {
        $pictureToConvert = $this->hardDiskRepository->getImageFromPath($command->imagePath());
        $thumbnail = $pictureToConvert->convertToThumbnail($command->height(), $command->width());
        $this->cloudStorageRepository->save(
            $command->imagePath(),
            $thumbnail,
            $command->storageName(),
            $command->bucket()
        );
    }
}
