<?php

namespace App\Entity;

use App\Enum\FuelType;
use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[UniqueEntity(fields: ['name'])]
class Car
{
    const GAZOLE = 'gazole';
    const ESSENCE = 'essence';

    const FUEL_TYPES = [
        self::GAZOLE,
        self::ESSENCE
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[NotBlank]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[NotBlank]
    #[Choice(choices: self::FUEL_TYPES)]
    private $fuelType;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: CarBooking::class, orphanRemoval: true)]
    private $carBookings;

    public function __construct()
    {
        $this->carBookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    public function setFuelType(?string $fuelType): self
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    /**
     * @return Collection<int, CarBooking>
     */
    public function getCarBookings(): Collection
    {
        return $this->carBookings;
    }

    public function addCarBooking(CarBooking $carBooking): self
    {
        if (!$this->carBookings->contains($carBooking)) {
            $this->carBookings[] = $carBooking;
            $carBooking->setCar($this);
        }

        return $this;
    }

    public function removeCarBooking(CarBooking $carBooking): self
    {
        if ($this->carBookings->removeElement($carBooking)) {
            // set the owning side to null (unless already changed)
            if ($carBooking->getCar() === $this) {
                $carBooking->setCar(null);
            }
        }

        return $this;
    }
}
