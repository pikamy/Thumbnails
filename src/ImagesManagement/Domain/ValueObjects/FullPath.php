<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\ValueObjects;

class FullPath
{
    private string $fullPath;

    private function __construct(string $fullPath)
    {
        $this->fullPath = $fullPath;
    }

    public static function create(string $fullPath): self
    {
        return new self($fullPath);
    }

    public function __toString(): string
    {
        return $this->fullPath;
    }
}
