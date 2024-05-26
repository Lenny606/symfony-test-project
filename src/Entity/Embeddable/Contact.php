<?php

namespace App\Entity\Embeddable;

use Doctrine\ORM\Mapping as ORM;
#[ORM\Embeddable]
class Contact
{
    #[ORM\Column(nullable: true)]
    private ?string $firstName = null;
    #[ORM\Column(nullable: true)]
    private ?string $surname = null;
    #[ORM\Column(nullable: true)]
    private ?string $email = null;
    #[ORM\Column(nullable: true)]
    private ?string $phone = null;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
}