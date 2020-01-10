<?php

use Converters\OrgPrefixName;
use Model\Company;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require_once __DIR__ . '/vendor/autoload.php';

$nameConverter = new OrgPrefixName();
$normalizer = new ObjectNormalizer(null, $nameConverter);

$serializer = new Serializer([$normalizer], [new JsonEncoder()]);

$company = new Company();
$company->name = 'Acme Inc.';
$company->address = '123 Main Street, Big City';

$json = $serializer->serialize($company, 'json');
// {"org_name": "Acme Inc.", "org_address": "123 Main Street, Big City"}

print($json);

print("\n");

$companyCopy = $serializer->deserialize($json, Company::class, 'json');
// Same data as $company

print_r($companyCopy);
