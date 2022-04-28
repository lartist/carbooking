<?php

namespace App\Entity;

use App\Repository\CarBookingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarBookingRepository::class)]
class CarBooking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'carBookings')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: Car::class, inversedBy: 'carBookings')]
    #[ORM\JoinColumn(nullable: false)]
    private $car;

    #[ORM\Column(type: 'date')]
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        $this->car = $car;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
