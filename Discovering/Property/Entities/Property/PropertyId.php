<?php

declare(strict_types=1);

namespace App\RealEstate\Discovering\Property\Entities\Property;

use Webmozart\Assert\Assert;

final class PropertyId
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        Assert::uuid($value);
        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }
}
