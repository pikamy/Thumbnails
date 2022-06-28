<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\Exceptions;

class UploadProblem extends ValidationProblem
{
    public static function create(): self
    {
        return new self('UNEXPECTED_UPLOAD_ERROR');
    }
}
