<?php

namespace Palex\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Palex\BlogBundle\Repository\CityRepository")
 */
class City
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var Category[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Palex\BlogBundle\Entity\Category", inversedBy="cities")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection|Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection|Category[] $category
     *
     * @return $this
     */
    public function setCategories($category)
    {
        $this->categories = $category;

        return $this;
    }

    /**
     * @param Category $category
     *
     * @return $this
     */
    public function addCategory($category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * @param Category $category
     *
     * @return $this
     */
    public function removeCategory($category)
    {
        $this->categories->removeElement($category);

        return $this;
    }
}

