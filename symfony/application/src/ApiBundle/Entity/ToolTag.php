<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Ldap\Adapter\ExtLdap\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * ToolTag
 *
 * @ORM\Table(name="tool_tag")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ToolTagRepository")
 */
class ToolTag
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
     * @var Tool
     * @Assert\NotBlank()
     *
     * Many ToolTags have One Tool
     *
     * @ORM\ManyToOne(targetEntity="Tool")
     * @ORM\JoinColumn(name="tool_id", referencedColumnName="id")
     */
    private $tool;

    /**
     * @var Tag
     * @Assert\NotBlank()
     *
     * Many ToolTags have One Tag
     *
     * @ORM\ManyToOne(targetEntity="Tag")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     */
    private $tag;


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
     * @param Tool $tool
     *
     * @return ToolTag
     */
    public function setTool($tool)
    {
        $this->tool = $tool;

        return $this;
    }

    /**
     * Get tool
     *
     * @return Tool
     */
    public function getTool()
    {
        return $this->tool;
    }

    /**
     * Set tag
     *
     * @param Tag $tag
     *
     * @return ToolTag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

}

