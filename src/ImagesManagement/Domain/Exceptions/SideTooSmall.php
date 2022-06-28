<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\Exceptions;

class SideTooSmall extends ValidationProblem
{
    public static function create(string $sideName): self
    {
        return new self(printf('%s_TO_SMALL', strtoupper($sideName)));
    }
}
