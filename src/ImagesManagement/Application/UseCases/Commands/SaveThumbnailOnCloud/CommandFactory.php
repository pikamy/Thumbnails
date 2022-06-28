<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnCloud;

use Thumbnails\ImagesManagement\Domain\ValueObjects\Width;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Bucket;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Height;
use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;
use Thumbnails\ImagesManagement\Domain\ValueObjects\StorageName;

class CommandFactory
{
    private SchemaValidator $schemaValidator;

    public function __construct(SchemaValidator $schemaValidator)
    {
        $this->schemaValidator = $schemaValidator;
    }

    public function build(array $data): Command
    {
        $this->schemaValidator->validate($data);

        $imagePath = FullPath::create($data['imagePath']);
        $height = Height::create((int)$data['height']);
        $width = Width::create((int)$data['width']);
        $bucket = Bucket::create($data['bucket']);
        $storageName = StorageName::create($data['storageName']);

        return new Command($imagePath, $height, $width, $bucket, $storageName);
    }
}
