<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnHardDisk;

use Thumbnails\ImagesManagement\Domain\ValueObjects\Width;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Height;
use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;

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
        $thumbnailPath = FullPath::create($data['thumbnailPath']);
        $height = Height::create((int)$data['height']);
        $width = Width::create((int)$data['width']);

        return new Command($imagePath, $thumbnailPath, $height, $width);
    }
}
