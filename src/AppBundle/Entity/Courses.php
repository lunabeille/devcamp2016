<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\News;

/**
 * @ORM\Entity()
 * @ORM\Table(name="courses_2016")
 */
class Courses extends News
{
    /** 
     * @ORM\Column(name="category", type="string", length=255, nullable=true) 
     */
    private $category;

    /**
     * @ORM\Column(name="id", type="integer")
     *
     */
    private $level;
