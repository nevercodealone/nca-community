<?php

namespace App\Entity;

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
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Vorname darf nicht leer sein.", groups={"Edit", "Profile"})
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
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Nachname darf nicht leer sein.", groups={"Edit", "Profile"})
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
     * @ORM\Column(type="string", length=15)
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
     * @return string
     */
    public function getFirstName()
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
    public function getLastName()
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
    public function getTwitter()
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


}
