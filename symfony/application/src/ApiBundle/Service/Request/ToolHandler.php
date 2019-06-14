<?php
namespace ApiBundle\Service\Request;

use ApiBundle\Entity\Tag;
use ApiBundle\Entity\Tool;
use \Symfony\Component\HttpFoundation\Request;

/**
 * Class ToolHandler
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Service\Request
 */
class ToolHandler
{
    /** @var Request $request */
    private $request;

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request) : ToolHandler
    {
        $this->request = $request;

        return $this;
    }
    /**
     * @throws \Exception
     */
    public function parseToolsFromRequest() : Tool
    {
        $toolArray = json_decode($this->request->getContent(), true);

        $tool = new Tool();

        $tool
            ->setDescription($tool['description'])
            ->setLink($tool['link'])
            ->setTitle($tool['title']);

        if (isset($toolArray['tags']) and !empty($toolArray['tags'])) {
            foreach ($toolArray['tags'] as $tagTitle) {
                $tag = new Tag();
                $tag->setTitle($tagTitle);

                $tool->addTag($tag);
            }
        }

        return $tool;
    }
}