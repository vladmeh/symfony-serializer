<?php

use Model\Person;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require 'vendor/autoload.php';

$person = new Person();
$person->setName('foo');
$person->setAge(99);
$person->setSportsperson(false);

$encoders = [new XmlEncoder(), new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);

$jsonContent = $serializer->serialize($person, 'json');

// $jsonContent contains {"name":"foo","age":99,"sportsperson":false,"createdAt":null}

echo $jsonContent; // or return it in a Response

echo "\n";

$xmlContent = $serializer->serialize($person, 'xml');

echo $xmlContent;
