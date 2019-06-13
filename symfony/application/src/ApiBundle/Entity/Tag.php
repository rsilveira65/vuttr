<?php

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Tag
 *
 * @ORM\Table(name="tags")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\TagRepository")
 */
class Tag
{
    /**
     * @Groups({"ApiResponse"})
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Groups({"ApiResponse"})
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="Tool", mappedBy="tags")
     *
     */
    private $tools;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tools = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Tag
     */
    public function setId($id)
    {
         $this->id = $id;

         return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Tag
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Add tool
     *
     * @param Tool $tool
     *
     * @return Tag
     */
    public function addTool(Tool $tool)
    {
        $this->tools[] = $tool;

        return $this;
    }

    /**
     * Remove tool
     *
     * @param Tool $tool
     */
    public function removeTool(Tool $tool)
    {
        $this->tools->removeElement($tool);
    }

    /**
     * Get products
     *
     * @return Collection
     */
    public function getTools()
    {
        return $this->tools;
    }

}

