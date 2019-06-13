<?php

namespace ApiBundle\Controller;

use ApiBundle\Service\Normalize\ToolNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route("/tools", name="api_tools")
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
}