<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use App\Services\Traits\WithUUIDTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['id'])]
class Product
{
    use WithUUIDTrait;
    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(length: 255)]
    private string $description;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at;
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

}