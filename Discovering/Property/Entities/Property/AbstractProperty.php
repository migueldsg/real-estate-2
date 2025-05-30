<?php
declare(strict_types=1);

namespace App\RealEstate\Discovering\Property\Entities\Property;

use Doctrine\ORM\Mapping as ORM;

abstract class AbstractProperty
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column("type"="string")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column("type"="string", nullable=true)
     */
    private $description;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
