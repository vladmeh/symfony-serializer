<?php

use Model\Person;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require 'vendor/autoload.php';

$data = <<<EOF
<person>
    <name>foo</name>
    <age>99</age>
    <city>Paris</city>
</person>
EOF;


$encoders = [new XmlEncoder(), new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);

// this will throw a Symfony\Component\Serializer\Exception\ExtraAttributesException
// because "city" is not an attribute of the Person class

try {
    $person = $serializer->deserialize($data, Person::class, 'xml', [
        AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false,
    ]);
    var_dump($person);

} catch (Exception $e) {
    echo $e->getMessage();
}
