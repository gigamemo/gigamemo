<?php

namespace App\Entity;

use App\Repository\DeckRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DeckRepository::class)]
class Deck
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(max: 70, maxMessage: 'This value cannot be longer than 70 characters.')]
    #[ORM\Column(length: 70)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'deckChilds')]
    private ?self $deckParent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'deckParent')]
    private Collection $deckChilds;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    public function __construct()
    {
        $this->deckChilds = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDeckParent(): ?self
    {
        return $this->deckParent;
    }

    public function setDeckParent(?self $deckParent): static
    {
        $this->deckParent = $deckParent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getDeckChilds(): Collection
    {
        return $this->deckChilds;
    }

    public function addDeckChild(self $deckChild): static
    {
        if (!$this->deckChilds->contains($deckChild)) {
            $this->deckChilds->add($deckChild);
            $deckChild->setDeckParent($this);
        }

        return $this;
    }

    public function removeDeckChild(self $deckChild): static
    {
        if ($this->deckChilds->removeElement($deckChild)) {
            // set the owning side to null (unless already changed)
            if ($deckChild->getDeckParent() === $this) {
                $deckChild->setDeckParent(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): static
    {
        $this->position = $position;

        return $this;
    }
}
