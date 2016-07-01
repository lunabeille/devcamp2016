<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="profile_2016")
 */
class Profile
{
    const COLOR_RED = '#FF0000';
    const COLOR_YELLOW = '#FFFF00';
    const COLOR_GREEN = '#00FF00';

    public function __construct()
    {
        $this->favoriteColors = [
            self::COLOR_RED,
        ];
    }

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="favorite_colors", type="array")
     */
    private $favoriteColors;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set favoriteColors.
     *
     * @param array $favoriteColors
     *
     * @return Profile
     */
    public function setFavoriteColors($favoriteColors)
    {
        $this->favoriteColors = $favoriteColors;

        return $this;
    }

    /**
     * Get favoriteColors.
     *
     * @return array
     */
    public function getFavoriteColors()
    {
        return $this->favoriteColors;
    }
}
