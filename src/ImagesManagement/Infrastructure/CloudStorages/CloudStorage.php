<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Infrastructure\CloudStorages;

use Thumbnails\ImagesManagement\Domain\ValueObjects\Bucket;
use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;
use Thumbnails\ImagesManagement\Domain\Exceptions\UploadProblem;

interface CloudStorage
{
    /**
     * @param FullPath $filePath
     * @param Bucket $bucket
     * @return void
     * @throws UploadProblem
     */
    public function upload(FullPath $filePath, Bucket $bucket): void;
}
