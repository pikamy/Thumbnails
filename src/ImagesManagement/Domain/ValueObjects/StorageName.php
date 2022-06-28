<?php

declare(strict_types=1);

namespace Thumbnails\ImagesManagement\Domain\ValueObjects;

class StorageName
{
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name): self
    {
        return new self($name);
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
