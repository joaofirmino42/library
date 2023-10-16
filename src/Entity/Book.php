<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $book_id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(nullable: true)]
    private ?int $Unit = null;

    public function getId(): ?int
    {
        return $this->book_id;
    }

    public function getBookId(): ?int
    {
        return $this->book_id;
    }

    public function setBookId(int $BookId): static
    {
        $this->book_id = $BookId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getUnit(): ?int
    {
        return $this->Unit;
    }

    public function setUnit(?int $Unit): static
    {
        $this->Unit = $Unit;

        return $this;
    }
}
