<?php

require_once __DIR__ . '/bootstrap.php';

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Loader\XmlFileLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
//$classMetadataFactory = new ClassMetadataFactory(new XmlFileLoader('./config/config.xml'));
//$classMetadataFactory = new ClassMetadataFactory(new YamlFileLoader('./config/config.yaml'));

$obj = new MyObj();
$obj->foo = 'foo';
$obj->setBar('bar');

$normalizer = new ObjectNormalizer($classMetadataFactory);
$serializer = new Serializer([$normalizer]);

try {
    $data = $serializer->normalize($obj, null, ["groups" => ["group3"]]);

} catch (ExceptionInterface $e) {
    echo $e->getMessage();
}
// $data = ['foo' => 'foo'];


try {
    $obj2 = $serializer->denormalize(
        ["foo" => "foo", "bar" => "bar"],
        MyObj::class,
        null,
        ["groups" => ["group1", "group3"]]
    );

    print_r($obj2->foo);
} catch (ExceptionInterface $e) {
    echo $e->getMessage();
}
// $obj2 = MyObj(foo: 'foo', bar: 'bar')