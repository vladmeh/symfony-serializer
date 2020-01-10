<?php

use Model\Person;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require 'vendor/autoload.php';

$encoders = [new XmlEncoder(), new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);

$person = new Person();
$person->setName('bar');
$person->setAge(99);
$person->setSportsperson(true);

$data = <<<EOF
<person>
    <name>foo</name>
    <age>69</age>
</person>
EOF;

$person = $serializer->deserialize($data, Person::class, 'xml', [AbstractNormalizer::OBJECT_TO_POPULATE => $person]);

var_dump($person);
