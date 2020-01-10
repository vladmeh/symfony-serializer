<?php

use Symfony\Component\Serializer\Encoder\XmlEncoder;

require_once __DIR__ . '/vendor/autoload.php';

$encoder = new XmlEncoder();

$data = ['foo' => [1, 2], 'bar' => true];

$output = $encoder->encode($data, 'xml');

echo $output;

$xml = $encoder->encode([
    'foo' => ['@bar' => 'value'],
    'qux' => ['#comment' => 'A comment'],
], 'xml');

simplexml_load_string($xml)->saveXML('data/example.xml');

echo $encoder->encode([
    'FOO' => [
        '@bar' => 'value',
        '#' => 'baz'
    ]
], 'xml', ['xml_root_node_name' => 'RESPONSE']);
