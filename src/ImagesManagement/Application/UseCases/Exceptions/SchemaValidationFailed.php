<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Application\UseCases\Exceptions;

use Thumbnails\ImagesManagement\Domain\Exceptions\ValidationProblem;

class SchemaValidationFailed extends ValidationProblem
{
    public static function create(string $messageCode): self
    {
        return new self($messageCode);
    }
}
