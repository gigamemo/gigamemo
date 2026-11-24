<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'questionImages')]
    private ?Card $questionCard = null;

    #[ORM\ManyToOne(inversedBy: 'answerImages')]
    private ?Card $answerCard = null;

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

    public function getQuestionCard(): ?Card
    {
        return $this->questionCard;
    }

    public function setQuestionCard(?Card $questionCard): static
    {
        $this->questionCard = $questionCard;

        return $this;
    }

    public function getAnswerCard(): ?Card
    {
        return $this->answerCard;
    }

    public function setAnswerCard(?Card $answerCard): static
    {
        $this->answerCard = $answerCard;

        return $this;
    }
}
