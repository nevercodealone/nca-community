<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Der Vorname ist zu kurz.",
     *     maxMessage="Der Vorname ist zu lang.",
     *     groups={"Edit", "Profile"}
     * )
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Der Nachname ist zu kurz.",
     *     maxMessage="Der Nachname ist zu lang.",
     *     groups={"Edit", "Profile"}
     * )
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Twitter ist zu kurz.",
     *     maxMessage="Twitter ist zu lang.",
     *     groups={"Edit", "Profile"}
     * )
     */
    protected $twitter;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Job", mappedBy="owner")
     */
    private $ownedJobs;

    public function __construct()
    {
        parent::__construct();
        $this->ownedJobs = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    /**
     * @param string $twitter
     */
    public function setTwitter($twitter): void
    {
        $this->twitter = $twitter;
    }

    /**
     * @return Job[]
     */
    public function getOwnedJobs():array
    {
        return $this->ownedJobs->toArray();
    }

}
