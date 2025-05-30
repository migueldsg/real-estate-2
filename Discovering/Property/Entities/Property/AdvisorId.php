<?php

declare(strict_types=1);

namespace App\RealEstate\Discovering\Property\Entities\Property;

final class AdvisorId
{
    /**
     * @var int
     */
    private $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function fromInt(int $value): self
    {
        return new self($value);
    }

    public function toInt(): int
    {
        return $this->value;
    }
}
