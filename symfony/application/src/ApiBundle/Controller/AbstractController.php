<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Tag;
use ApiBundle\Entity\Tool;
use ApiBundle\Repository\ToolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractController
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Controller
 */
abstract class AbstractController extends Controller
{
    /**
     * @param $responseContent
     * @param int $responseCode
     * @return JsonResponse
     */
    protected function createResponse($responseContent, $responseCode = null) : JsonResponse
    {
        if ($responseContent instanceof \Exception) {
            $responseCode = !$responseCode ? Response::HTTP_BAD_REQUEST : $responseCode;

            return new JsonResponse(
                [
                    'message' => $responseContent->getMessage(),
                    'type' => 'error',
                    'status' => 'error',
                    'file' => $responseContent->getFile(),
                    'line' => $responseContent->getLine(),
                ],
                $responseCode
            );
        }

        $responseCode = !$responseCode ? Response::HTTP_OK : $responseCode;
        return new JsonResponse(
            $responseContent,
            $responseCode
        );
    }

    /**
     * @return array
     */
    protected function getTools()
    {
        return $this->getDoctrine()->getManager()->getRepository(Tool::class)->findAll();
    }


    /**
     * @param string $tag
     * @return array|null
     * @throws \Exception
     */
    protected function getToolsByTag(string $tag)
    {
        $tagEntity = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Tag::class)
            ->findOneBy(['title' => $tag]);


        if (!$tagEntity instanceof Tag) { throw new \Exception('Invalid tag name.');}

        return $tagEntity->getTools();
    }
}