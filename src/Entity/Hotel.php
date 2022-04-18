<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column(type: 'integer')]
  private $id;

  #[ORM\Column(type: 'string', length: 255)]
  private $name;

  #[ORM\Column(type: 'string', length: 255)]
  private $city;

  #[ORM\Column(type: 'string', length: 255)]
  private $adress;

  #[ORM\Column(type: 'text')]
  private $description;

  #[ORM\Column(type: 'string', length: 255)]
  private $hotelImage;

  #[ORM\Column(type: 'string', length: 255)]
  private $manager_name;

  #[ORM\OneToMany(mappedBy: 'hotel_relation', targetEntity: Room::class)]
  private $room_relation;

  #[ORM\OneToMany(mappedBy: 'Hotel', targetEntity: Reservation::class)]
  private $reservations;

  public function __construct()
  {
    $this->rooms = new ArrayCollection();
    $this->Room_relation = new ArrayCollection();
    $this->room_relation = new ArrayCollection();
    $this->reservations = new ArrayCollection();
  }

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

  public function getCity(): ?string
  {
    return $this->city;
  }

  public function setCity(string $city): self
  {
    $this->city = $city;

    return $this;
  }

  public function getAdress(): ?string
  {
    return $this->adress;
  }

  public function setAdress(string $adress): self
  {
    $this->adress = $adress;

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

  /**
   * @return Collection<int, Room>
   */
  public function getRooms(): Collection
  {
    return $this->rooms;
  }

  public function getHotelImage(): ?string
  {
    return $this->hotelImage;
  }

  public function setHotelImage(string $hotelImage): self
  {
    $this->hotelImage = $hotelImage;

    return $this;
  }

  public function getManagerName(): ?string
  {
    return $this->manager_name;
  }

  public function setManagerName(?string $manager_name): self
  {
    $this->manager_name = $manager_name;

    return $this;
  }

  /**
   * @return Collection<int, Room>
   */
  public function getRoomRelation(): Collection
  {
    return $this->room_relation;
  }

  public function addRoomRelation(Room $roomRelation): self
  {
    if (!$this->room_relation->contains($roomRelation)) {
      $this->room_relation[] = $roomRelation;
      $roomRelation->setHotelRelation($this);
    }

    return $this;
  }

  public function removeRoomRelation(Room $roomRelation): self
  {
    if ($this->room_relation->removeElement($roomRelation)) {
      // set the owning side to null (unless already changed)
      if ($roomRelation->getHotelRelation() === $this) {
        $roomRelation->setHotelRelation(null);
      }
    }

    return $this;
  }

  /**
   * @return Collection<int, Reservation>
   */
  public function getReservations(): Collection
  {
      return $this->reservations;
  }

  public function addReservation(Reservation $reservation): self
  {
      if (!$this->reservations->contains($reservation)) {
          $this->reservations[] = $reservation;
          $reservation->setHotel($this);
      }

      return $this;
  }

  public function removeReservation(Reservation $reservation): self
  {
      if ($this->reservations->removeElement($reservation)) {
          // set the owning side to null (unless already changed)
          if ($reservation->getHotel() === $this) {
              $reservation->setHotel(null);
          }
      }

      return $this;
  }
}
