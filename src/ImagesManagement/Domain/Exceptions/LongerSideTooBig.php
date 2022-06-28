<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\Exceptions;

class LongerSideTooBig extends ValidationProblem
{
    public static function create(): self
    {
        return new self('LONGER_SIDE.TOO_BIG');
    }
}
