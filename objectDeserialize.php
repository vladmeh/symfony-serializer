<?php

use Model\Person;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require 'vendor/autoload.php';

$encoders = [new XmlEncoder(), new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);

$data = <<<EOF
<person>
    <name>foo</name>
    <age>99</age>
    <sportsperson>false</sportsperson>
    <city>Paris</city>
</person>
EOF;

$person = $serializer->deserialize($data, Person::class, 'xml');

var_dump($person);