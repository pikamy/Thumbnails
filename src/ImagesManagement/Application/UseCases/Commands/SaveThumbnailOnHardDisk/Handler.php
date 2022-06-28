<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnHardDisk;

use Thumbnails\ImagesManagement\Domain\HardDiskRepository;
use Thumbnails\ImagesManagement\Domain\Exceptions\ValidationProblem;

class Handler
{
    private HardDiskRepository $repository;

    public function __construct(HardDiskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Command $command
     * @return void
     * @throws ValidationProblem
     */
    public function handle(Command $command): void
    {
        $imagesToConvert = $this->repository->getImageFromPath($command->imagePath());
        $thumbnail = $imagesToConvert->convertToThumbnail($command->height(), $command->width());
        $this->repository->save($command->imagePath(), $thumbnail, $command->thumbnailPath());
    }
}
