<?php

require_once __DIR__ . '/vendor/autoload.php';

use Model\Person;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

$encoder = new JsonEncoder();

// all callback parameters are optional (you can omit the ones you don't use)
$dateCallback = function ($innerObject, $outerObject, string $attributeName, string $format = null, array $context = []) {
    return $innerObject instanceof \DateTime ? $innerObject->format(\DateTime::ISO8601) : '';
};

$defaultContext = [
    AbstractNormalizer::CALLBACKS => [
        'createdAt' => $dateCallback,
    ],
];

$normalizer = new GetSetMethodNormalizer(null, null, null, null, null, $defaultContext);

$serializer = new Serializer([$normalizer], [$encoder]);

$person = new Person('Kalvin Kline');
$person->setName('cordoval');
$person->setAge(34);
$person->setCreatedAt(new \DateTime('now'));

$output = $serializer->serialize($person, 'json');
// Output: {"name":"cordoval", "age": 34, "createdAt": "2014-03-22T09:43:12-0500"}

echo $output;