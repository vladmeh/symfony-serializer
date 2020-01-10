<?php

use Doctrine\Common\Annotations\AnnotationReader;
use Model\Person;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Loader\XmlFileLoader;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/bootstrap.php';

//$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
//$classMetadataFactory = new ClassMetadataFactory(new XmlFileLoader('./config/config.xml'));
$classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader('./config/config.yaml'));


$metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

$serializer = new Serializer(
    [new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter)],
    ['json' => new JsonEncoder()]
);

$serialized = $serializer->serialize(new Person("Kévin"), 'json');

print_r($serialized);


