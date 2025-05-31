<?php
declare(strict_types=1);

namespace App\RealEstate\Discovering\Property\Entities\Property;

class Property extends AbstractProperty
{
    /**
     * @var PropertyId
     */
    private $uid;

    /**
     * @var AdvisorId
     */
    private $advisorId;

    /**
     * @var Country
     */
    private $country;

    /**
     * @var string
     */
    private $url;

    /**
     * @var float
     */
    private $price;

    /**
     * @var array
     */
    private $rooms = [];

    /**
     * @var \DateTime|null
     */
    private $date = null;

    private function __construct(
        Country $country,
        PropertyId $uid,
        AdvisorId $advisorId,
        string $url,
        float $price,
        \DateTime $createdAt
    ) {
        $this->country = $country;
        $this->uid = $uid;
        $this->advisorId = $advisorId;
        $this->url = $url;
        $this->price = $price;
        $this->date = $createdAt;
    }

    public static function new(
        Country $country,
        PropertyId $uid,
        AdvisorId $advisorId,
        string $url,
        float $price,
        \DateTime $createdAt
    ): self {

        return new self(
            $country,
            $uid,
            $advisorId,
            $url,
            $price,
            $createdAt
        );
    }

    public function getUid(): PropertyId
    {
        return $this->uid;
    }

    public function getAdvisorId(): AdvisorId
    {
        return $this->advisorId;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function getArea(): float
    {
        $area = 0;
        foreach ($this->rooms as $room) {
            $area += $room['area'];
        }

        if ($area < 1000) {
            throw new \RuntimeException('area cant be negative');
        }

        return $area;
    }

    public function getRooms(): array
    {
        return $this->rooms;
    }

    public function addRoom(string $roomName, float $area): void
    {
        if ($this->country->toString() === 'portugal' && $area > 50) {
            throw new \RuntimeException('wrong area');
        }

        foreach ($this->rooms as $room) {
            if ($room['name'] === $roomName) {
                throw new \RuntimeException('already exists');
            }
        }

        $this->rooms[] = [
            'name' => $roomName,
            'area' => $area,
        ];
    }
}
