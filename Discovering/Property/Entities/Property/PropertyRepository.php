<?php
declare(strict_types=1);

namespace App\RealEstate\Discovering\Property\Entities\Property;

interface PropertyRepository
{
    public function add(Property $property): void;

    public function get(string $uid, int $advisorId): ?Property;
}
