<?php

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Ldap\Adapter\ExtLdap\Collection;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Tool
 *
 * @ORM\Table(name="tools")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ToolRepository")
 */
class Tool
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
     * @Groups({"ApiResponse"})
     * @var string
     *
     * @ORM\Column(name="link", type="string")
     */
    private $link;

    /**
     * @Groups({"ApiResponse"})
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @Groups({"ApiResponse"})
     * @var Collection
     */
    private $tags;

    /**
     * Tool constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $title
     *
     * @return Tool
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Tool
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tool
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * @param Tag $tag
     * @return Tool
     */
    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);

        return $this;
    }

    /**
     * @param ArrayCollection $tags
     * @return Tool
     */
    public function addTags(ArrayCollection $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTags()
    {
        return $this->tags;
    }


}

