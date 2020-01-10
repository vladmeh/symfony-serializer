<?php

use Model\Company;
use Model\User;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require 'vendor/autoload.php';

$company = new Company();
$company->name = 'Les-Tilleuls.coop';
$company->address = 'Lille, France';

$user = new User();
$user->familyName = 'Dunglas';
$user->givenName = 'Kévin';
$user->company = $company;

$serializer = new Serializer([new ObjectNormalizer()]);

try {
    $data = $serializer->normalize($user, null, [AbstractNormalizer::ATTRIBUTES => ['familyName', 'company' => ['name']]]);
    print_r($data);
} catch (ExceptionInterface $e) {
    echo $e->getMessage();
}
// $data = ['familyName' => 'Dunglas', 'company' => ['name' => 'Les-Tilleuls.coop']];
