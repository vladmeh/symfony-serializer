<?php

use Model\Person;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/vendor/autoload.php';

$person = new Person();
$person->setName('foo');
$person->setAge(99);

$normalizer = new ObjectNormalizer();
$encoder = new JsonEncoder();

$serializer = new Serializer([$normalizer], [$encoder]);
$output = $serializer->serialize($person, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['age', 'createdAt', 'sportsperson']]);

// Output: {"name":"foo"}

print_r($output);