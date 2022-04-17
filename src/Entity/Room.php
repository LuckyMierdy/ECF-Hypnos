<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'string', length: 255)]
  private $name;

  #[ORM\Column(type: 'text')]
  private $description;

  #[ORM\Column(type: 'string', length: 255)]
  private $price;

  #[ORM\Column(type: 'string', length: 255)]
  private $manager_name;

  #[ORM\Column(type: 'string', length: 255)]
  private $room_image;

  #[ORM\ManyToOne(targetEntity: Hotel::class, inversedBy: 'room_relation')]
  private $hotel_relation;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getDescription(): ?string
  {
    return $this->description;
  }

  public function setDescription(string $description): self
  {
    $this->description = $description;

    return $this;
  }

  public function getPrice(): ?string
  {
    return $this->price;
  }

  public function setPrice(string $price): self
  {
    $this->price = $price;

    return $this;
  }

  public function getManagerName(): ?string
  {
    return $this->manager_name;
  }

  public function setManagerName(string $manager_name): self
  {
    $this->manager_name = $manager_name;

    return $this;
  }

  public function getRoomImage(): ?string
  {
    return $this->room_image;
  }

  public function setRoomImage(string $room_image): self
  {
    $this->room_image = $room_image;

    return $this;
  }

  public function getHotelRelation(): ?Hotel
  {
      return $this->hotel_relation;
  }

  public function setHotelRelation(?Hotel $hotel_relation): self
  {
      $this->hotel_relation = $hotel_relation;

      return $this;
  }
}
