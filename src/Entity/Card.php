<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $countLearning = null;

    #[ORM\Column]
    private ?int $countReduce = null;

    #[ORM\Column]
    private ?int $countMaintain = null;

    #[ORM\Column]
    private ?int $countExtend = null;

    #[ORM\Column]
    private ?float $easyFactor = null;

    #[ORM\Column]
    private ?int $interval = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $nextDisplayDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $question = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answer = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answerTemplate = null;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'questionCard')]
    private Collection $questionImages;

    /**
     * @var Collection<int, Image>
     */
    #[ORM\OneToMany(targetEntity: Image::class, mappedBy: 'answerCard')]
    private Collection $answerImages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountLearning(): ?int
    {
        return $this->countLearning;
    }

    public function setCountLearning(int $countLearning): static
    {
        $this->countLearning = $countLearning;

        return $this;
    }

    public function getCountReduce(): ?int
    {
        return $this->countReduce;
    }

    public function setCountReduce(int $countReduce): static
    {
        $this->countReduce = $countReduce;

        return $this;
    }

    public function getCountMaintain(): ?int
    {
        return $this->countMaintain;
    }

    public function setCountMaintain(int $countMaintain): static
    {
        $this->countMaintain = $countMaintain;

        return $this;
    }

    public function getCountExtend(): ?int
    {
        return $this->countExtend;
    }

    public function setCountExtend(int $countExtend): static
    {
        $this->countExtend = $countExtend;

        return $this;
    }

    public function getEasyFactor(): ?float
    {
        return $this->easyFactor;
    }

    public function setEasyFactor(float $easyFactor): static
    {
        $this->easyFactor = $easyFactor;

        return $this;
    }

    public function getInterval(): ?int
    {
        return $this->interval;
    }

    public function setInterval(int $interval): static
    {
        $this->interval = $interval;

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

    public function getNextDisplayDate(): ?\DateTimeImmutable
    {
        return $this->nextDisplayDate;
    }

    public function setNextDisplayDate(\DateTimeImmutable $nextDisplayDate): static
    {
        $this->nextDisplayDate = $nextDisplayDate;

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

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(?string $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function getAnswerTemplate(): ?string
    {
        return $this->answerTemplate;
    }

    public function setAnswerTemplate(?string $answerTemplate): static
    {
        $this->answerTemplate = $answerTemplate;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getQuestionImages(): Collection
    {
        return $this->questionImages;
    }

    public function addQuestionImage(Image $questionImage): static
    {
        if (!$this->questionImages->contains($questionImage)) {
            $this->questionImages->add($questionImage);
            $questionImage->setQuestionCard($this);
        }

        return $this;
    }

    public function removeQuestionImage(Image $questionImage): static
    {
        if ($this->questionImages->removeElement($questionImage)) {
            // set the owning side to null (unless already changed)
            if ($questionImage->getQuestionCard() === $this) {
                $questionImage->setQuestionCard(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getAnswerImages(): Collection
    {
        return $this->answerImages;
    }

    public function addAnswerImage(Image $answerImage): static
    {
        if (!$this->answerImages->contains($answerImage)) {
            $this->answerImages->add($answerImage);
            $answerImage->setAnswerCard($this);
        }

        return $this;
    }

    public function removeAnswerImage(Image $answerImage): static
    {
        if ($this->answerImages->removeElement($answerImage)) {
            // set the owning side to null (unless already changed)
            if ($answerImage->getAnswerCard() === $this) {
                $answerImage->setAnswerCard(null);
            }
        }

        return $this;
    }

    public function __construct()
    {
        $this->countLearning   = 0;
        $this->countReduce     = 0;
        $this->countMaintain   = 0;
        $this->countExtend     = 0;
        $this->createdAt       = new \DateTimeImmutable();
        $this->updatedAt       = new \DateTimeImmutable();
        $this->nextDisplayDate = new \DateTimeImmutable();
        $this->easyFactor      = 0.0;
        $this->interval        = 0;
        $this->questionImages = new ArrayCollection();
        $this->answerImages = new ArrayCollection();
    }
}
