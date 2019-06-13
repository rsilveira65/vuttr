<?php

namespace ApiBundle\DataFixtures\ORM;

use ApiBundle\Entity\Tag;
use ApiBundle\Entity\Tool;
use ApiBundle\Entity\ToolTag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadCompanies
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\DataFixtures\ORM
 */
class LoadTools extends AbstractFixture
{
    /** @var array $tools  */
    private $tools = [
        [
            'Title' => 'Notion',
            'Link' => 'https://notion.so',
            'Description' => 'All in one tool to organize teams and ideas. Write, plan, collaborate, and get organized.',
            'Tags' => ['organization', 'planning', 'collaboration', 'writing', 'calendar']
        ],
        [
            'Title' => 'json-server',
            'Link' => 'https://github.com/typicode/json-server',
            'Description' => 'Fake REST API based on a json schema. Useful for mocking and creating APIs for front-end devs to consume in coding challenges.',
            'Tags' => ['api', 'json', 'schema', 'node', 'github', 'rest']
        ],
        [
            'Title' => 'fastify',
            'Link' => 'https://www.fastify.io/',
            'Description' => 'Extremely fast and simple, low-overhead web framework for NodeJS. Supports HTTP2.',
            'Tags' => ['web', 'framework', 'node', 'node', 'http2', 'https', 'rest']
        ],
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $newTags = [];

        foreach ($this->tools as $tool) {
            $toolEntity = new Tool();
            foreach ($tool as $key => $toolData) {
                if ($key === 'Tags') {

                    foreach ($tool['Tags'] as $tagTitle) {

                        $newTags[] = $this->createNewTag($manager, $tagTitle);
                    }

                    continue;
                }

                $method = sprintf('set%s', $key);

                $toolEntity->{$method}($toolData);
            }

            $manager->persist($toolEntity);

            foreach ($newTags as $newTag) {
                $toolTag = new ToolTag();
                $toolTag
                    ->setTag($newTag)
                    ->setTool($toolEntity);

                $manager->persist($toolTag);
            }
        }

        $manager->flush();
    }


    /**
     * @param ObjectManager $manager
     * @param string $tagTitle
     * @return Tag|object|null
     */
    private function createNewTag(ObjectManager $manager, string $tagTitle)
    {
        $tagAlreadyExists = $manager->getRepository(Tag::class)->findOneBy(['title' => $tagTitle]);

        if ($tagAlreadyExists instanceof Tag) {
            return $tagAlreadyExists;
        }

        $newTag = (new Tag())->setTitle($tagTitle);

        $manager->persist($newTag);
        $manager->flush();

        return $newTag;
    }

}