<?php

use Model\Person;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

require_once __DIR__ . '/vendor/autoload.php';

$normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());

$kevin = new Person('Kévin');
try {
    $data = $normalizer->normalize($kevin);
    print_r($data['first_name']);
} catch (ExceptionInterface $e) {
    echo $e->getMessage();
}
// ['first_name' => 'Kévin'];

print_r("\n");

try {
    $anne = $normalizer->denormalize(['first_name' => 'Anne'], Person::class);
    print_r($anne->getFirstName());
} catch (ExceptionInterface $e) {
    $e->getMessage();
}
// Person object with firstName: 'Anne'
