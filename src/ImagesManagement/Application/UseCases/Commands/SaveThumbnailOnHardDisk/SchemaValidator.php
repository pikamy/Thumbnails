<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Application\UseCases\Commands\SaveThumbnailOnHardDisk;

use Thumbnails\ImagesManagement\Application\UseCases\Exceptions\SchemaValidationFailed;

class SchemaValidator
{
    /**
     * @param array $data
     * @return void
     * @throws SchemaValidationFailed
     */
    public function validate(array $data): void
    {
        $this->validateThumbnailPath($data);
        $this->validateImagePath($data);
        $this->validateHeight($data);
        $this->validateWidth($data);
    }

    private function validateHeight(array $data)
    {
        if (!\array_key_exists('height', $data)) {
            throw SchemaValidationFailed::create('HEIGHT.MISSING');
        }

        if (
            !\is_numeric($data['height'])
            || !\is_int((int)($data['height']))
        ) {
            throw SchemaValidationFailed::create('HEIGHT.INVALID_TYPE');
        }
    }

    private function validateWidth(array $data)
    {
        if (!\array_key_exists('width', $data)) {
            throw SchemaValidationFailed::create('WIDTH.MISSING');
        }

        if (!\is_numeric($data['width'])
            || !\is_int((int)($data['width']))
        ) {
            throw SchemaValidationFailed::create('WIDTH.INVALID_TYPE');
        }
    }

    private function validateImagePath(array $data)
    {
        if (!\array_key_exists('imagePath', $data)) {
            throw SchemaValidationFailed::create('IMAGE_PATH.MISSING');
        }
    }

    private function validateThumbnailPath(array $data)
    {
        if (!\array_key_exists('thumbnailPath', $data)) {
            throw SchemaValidationFailed::create('THUMBNAIL_PATH.MISSING');
        }
    }
}
