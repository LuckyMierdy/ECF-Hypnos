<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $checkIn;

    #[ORM\Column(type: 'date')]
    private $checkOut;

    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'reservations')]
    private $Room;

    #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'reservations')]
    private $Hotel;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservations')]
    private $User;

    #[ORM\Column(type: 'string', length: 255)]
    private $hotel_id;

    #[ORM\Column(type: 'string', length: 255)]
    private $room_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheckIn(): ?\DateTimeInterface
    {
        return $this->checkIn;
    }

    public function setCheckIn(\DateTimeInterface $checkIn): self
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    public function getCheckOut(): ?\DateTimeInterface
    {
        return $this->checkOut;
    }

    public function setCheckOut(\DateTimeInterface $checkOut): self
    {
        $this->checkOut = $checkOut;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->Room;
    }

    public function setRoom(?Room $Room): self
    {
        $this->Room = $Room;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->Hotel;
    }

    public function setHotel(?Hotel $Hotel): self
    {
        $this->Hotel = $Hotel;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getHotelId(): ?string
    {
        return $this->hotel_id;
    }

    public function setHotelId(string $hotel_id): self
    {
        $this->hotel_id = $hotel_id;

        return $this;
    }

    public function getRoomId(): ?string
    {
        return $this->room_id;
    }

    public function setRoomId(string $room_id): self
    {
        $this->room_id = $room_id;

        return $this;
    }
}
