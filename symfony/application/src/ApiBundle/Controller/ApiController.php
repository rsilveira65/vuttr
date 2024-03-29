<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Tool;
use ApiBundle\Service\Normalize\ToolNormalizer;
use ApiBundle\Service\Request\ToolHandler;
use Doctrine\Common\Collections\Collection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;



/**
 * Class ApiController
 * @Route("/")
 *
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Controller
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/tools", name="get_tools")
     * @Method("GET")
     * @return JsonResponse
     */
    public function toolAction() : JsonResponse
    {
        try {

            /** @var ToolNormalizer $toolNormalizer */
            $toolNormalizer = $this->get('api.tool_normalizer');

            $tools = $this->getTools();

            return $this->createResponse(
                $toolNormalizer
                    ->normalize(
                        $tools,
                        ['groups' => ['ApiResponse']]
                    ),
                Response::HTTP_OK
            );

        } catch (\Exception $ex) {
            return $this->createResponse($ex, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @Route("/tools", name="add_tools")
     * @Method("POST")
     * @return JsonResponse
     */
    public function addToolAction(Request $request) : JsonResponse
    {
        try {

            /** @var ToolHandler $toolHandler */
            $toolHandler = $this->get('api.tool_handler');

            /** @var ToolNormalizer $toolNormalizer */
            $toolNormalizer = $this->get('api.tool_normalizer');

            /** @var Tool $tool */
            $tool = $toolHandler
                ->setRequest($request)
                ->parseToolsFromRequest();

            return $this->createResponse(
                $toolNormalizer
                    ->normalize(
                        [$tool],
                        ['groups' => ['ApiResponse']]
                    ),
                Response::HTTP_OK
            );

        } catch (\Exception $ex) {
            return $this->createResponse($ex, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Route("/tools/id/{tool}", name="delete_tools")
     * @Method("DELETE")
     * @param Tool $tool
     * @return JsonResponse
     */
    public function deleteToolAction(Tool $tool) : JsonResponse
    {
        try {

            $this->getDoctrine()->getManager()->remove($tool);
            $this->getDoctrine()->getManager()->flush();

            return $this->createResponse(
                'Tool has been deleted!',
                Response::HTTP_OK
            );

        } catch (\Exception $ex) {
            return $this->createResponse($ex, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @Route("/tools/tag/{tag}", name="search_tools")
     * @Method("GET")
     * @param string $tag
     * @return JsonResponse
     */
    public function searchToolAction(string $tag) : JsonResponse
    {
        try {

            /** @var ToolNormalizer $toolNormalizer */
            $toolNormalizer = $this->get('api.tool_normalizer');

            /** @var Tool $tool */
            $tools = $this->getToolsByTag($tag);

            return $this->createResponse(
                $toolNormalizer
                    ->normalize(
                        $tools->toArray(),
                        ['groups' => ['ApiResponse']]
                    ),
                Response::HTTP_OK
            );

        } catch (\Exception $ex) {
            return $this->createResponse($ex, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}