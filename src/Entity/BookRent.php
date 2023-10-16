<?php



namespace App\Entity;

use App\Repository\BookRentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Book;
#[ORM\Entity(repositoryClass: BookRentRepository::class)]
class BookRent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $BookRentId = null;

    #[ORM\Column]
    private ?bool $Status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $ExpirationDate = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $valor = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateRent = null;
    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'products')]
    private Book $book;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'products')]
    private User $user;

    #[ORM\Column]
    private ?int $book_id = null;
    #[ORM\Column]
    private ?int $id_user = null;
    public function getId(): ?int
    {
        return $this->id;
    }



    public function getStatus(): ?bool
    {
        return $this->Status;
    }

    public function setStatus(bool $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->ExpirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $ExpirationDate): static
    {
        $this->ExpirationDate = $ExpirationDate;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    public function getDateRent(): ?\DateTimeInterface
    {
        return $this->DateRent;
    }

    public function setDateRent(\DateTimeInterface $DateRent): static
    {
        $this->DateRent = $DateRent;

        return $this;
    }
    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
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

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
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
 public function getBook(): ?Book
    {
        return $this->book;
    }


}
/*
    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
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
 public function getBook(): ?Book
    {
        return $this->book;
    }
*\
   

