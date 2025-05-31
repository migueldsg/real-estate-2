<?php

declare(strict_types=1);

namespace App\RealEstate\Discovering\Property\UseCases\Property\AddPropertyForAdvisor;

class AddPropertyForAdvisorRequest
{
    /**
     * @var string
     */
    private $uid;

    /**
     * @var int
     */
    private $advisorId;

    /**
     * @var string
     */
    private $url;

    /**
     * @var float
     */
    private $price;

    public function __construct(string $uid, int $advisorId, string $url, float $price)
    {
        $this->uid = $uid;
        $this->advisorId = $advisorId;
        $this->url = $url;
        $this->price = $price;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function getAdvisorId(): int
    {
        return $this->advisorId;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
