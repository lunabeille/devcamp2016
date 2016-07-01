<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\MemberRepository")
 * @ORM\Table(
 *     name="member_2016",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="user_unique",columns={"username"})},
 *     indexes={@ORM\Index(name="user_idx", columns={"username"})})
 * )
 *
 * @see http://doctrine-orm.readthedocs.io/projects/doctrine-orm/en/latest/reference/annotations-reference.html
 */
class Member extends User
{
    public function __construct()
    {
        $this->profile = new Profile();
        $this->registrationDate = new \DateTime();
    }

    public function __toString()
    {
        return $this->getUsername();
    }

    /**
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Profile", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $profile;

    /**
     * @ORM\Column(name="avatar", type="string", nullable=true)
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\News", mappedBy="author")
     * 
     */
    private $news;


    /**
     * @ORM\Column(name="Registration_date", type="datetime")
     */
    private $registrationDate;

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    //////////////////////////////// ORM GENERATED METHODS ///////////////////////////////////////

    /**
     * Get id.
     *
     * @return guid
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set avatar.
     *
     * @param string $avatar
     *
     * @return Member
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar.
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set profile.
     *
     * @param \AppBundle\Entity\Profile $profile
     *
     * @return Member
     */
    public function setProfile(\AppBundle\Entity\Profile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile.
     *
     * @return \AppBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Get roles.
     *
     * @return array
     */
    public function getRoles()
    {
        return ['ROLE_MEMBER'];
    }


    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }


    public function getNews()
    {
        return $this->news;
    }

}
