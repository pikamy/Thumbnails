<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\Exceptions;

class StorageNotFound extends ValidationProblem
{
    public static function create(): self
    {
        return new self('STORAGE.NOT_FOUND');
    }
}
