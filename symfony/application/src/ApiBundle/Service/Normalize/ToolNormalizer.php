<?php
namespace ApiBundle\Service\Normalize;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Class ToolNormalizer
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @package ApiBundle\Service\Normalize
 */
class ToolNormalizer
{
    private $serializer;

    /**
     * CallNormalizer constructor.
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function __construct()
    {
        $encoders = [new JsonEncoder()];
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));

        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $normalizer->setCircularReferenceLimit(2);

        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $normalizers = [$normalizer];

        $this->serializer = new Serializer($normalizers, $encoders);
    }


    /**
     * @param array $tools
     * @param array $responseGroups
     * @return array|object|\Symfony\Component\Serializer\Normalizer\scalar
     */
    public function normalize(array $tools, array $responseGroups)
    {
        return $this->serializer->normalize($tools, null, $responseGroups);
    }
}