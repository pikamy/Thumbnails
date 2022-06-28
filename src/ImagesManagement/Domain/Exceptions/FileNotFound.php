<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\Exceptions;

class FileNotFound extends ValidationProblem
{
    public static function create(): self
    {
        return new self('FILE.NOT_FOUND');
    }
}
