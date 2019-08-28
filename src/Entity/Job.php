<?php

namespace App\Entity;

use App\Validator\Constraint\BadWords;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="5")
     * @Assert\NotBlank()
     * @BadWords(words={"Senior"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\Length(min="5", max="5")
     */
    private $zipcode;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $town;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ownedJobs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    public function __construct(User $owner)
    {
        $this->owner = $owner;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode($zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTown(): ?string
    {
        return $this->town;
    }

    /**
     * @param mixed $town
     */
    public function setTown($town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

}
