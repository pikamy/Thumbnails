<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\Exceptions;

class InvalidFileExtension extends ValidationProblem
{
    public static function create(): self
    {
        return new self('FILE.INVALID_EXTENSION');
    }
}
