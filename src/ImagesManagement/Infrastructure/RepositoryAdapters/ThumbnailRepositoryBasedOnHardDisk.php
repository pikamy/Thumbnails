<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Infrastructure\RepositoryAdapters;

use GdImage;
use Thumbnails\ImagesManagement\Domain\Image;
use Thumbnails\ImagesManagement\Domain\Thumbnail;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Width;
use Thumbnails\ImagesManagement\Domain\HardDiskRepository;
use Thumbnails\ImagesManagement\Domain\ValueObjects\Height;
use Thumbnails\ImagesManagement\Domain\ValueObjects\FullPath;
use Thumbnails\ImagesManagement\Domain\Exceptions\FileNotFound;
use Thumbnails\ImagesManagement\Domain\Exceptions\InvalidFileExtension;

class ThumbnailRepositoryBasedOnHardDisk implements HardDiskRepository
{
    public function getImageFromPath(FullPath $fullPath): Image
    {
        if (!\file_exists((string)$fullPath)) {
            throw FileNotFound::create();
        }

        list($width, $height) = getimagesize((string)$fullPath);

        return Image::recreate(Height::create((int)$height), Width::create((int)$width));
    }

    public function save(FullPath $imagePath, Thumbnail $thumbnail, FullPath $thumbnailPath): void
    {
        $extension = strtoupper(pathinfo((string)$imagePath, PATHINFO_EXTENSION));
        $destination = imagecreatetruecolor($thumbnail->width()->value(), $thumbnail->height()->value());
        switch (strtoupper($extension)) {
            case 'JPEG':
            case 'JPG':
                $source = imagecreatefromjpeg((string)$imagePath);
                $this->prepareImageResample($source, $destination, $thumbnail);
                imagejpeg($destination, (string)$thumbnailPath);
                break;
            case 'PNG':
                $source = imagecreatefrompng((string)$imagePath);
                $this->prepareImageResample($source, $destination, $thumbnail);
                imagepng($destination, (string)$thumbnailPath);
                break;
            default:
                throw InvalidFileExtension::create();
        }

        imagedestroy($source);
        imagedestroy($destination);
    }

    /**
     * @param resource|GdImage $source
     * @param resource|GdImage $destination
     * @param Thumbnail $thumbnail
     * @return void
     */
    private function prepareImageResample($source, $destination, Thumbnail $thumbnail): void
    {
        imagecopyresampled(
            $destination,
            $source,
            0,
            0,
            0,
            0,
            $thumbnail->width()->value(),
            $thumbnail->height()->value(),
            imagesx($source),
            imagesy($source)
        );
    }
}
