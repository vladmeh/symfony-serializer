<?php


namespace Converters;


use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class OrgPrefixName implements NameConverterInterface
{
    public function normalize($propertyName)
    {
        return 'org_'.$propertyName;
    }

    public function denormalize($propertyName)
    {
        // removes 'org_' prefix
        return 'org_' === substr($propertyName, 0, 4) ? substr($propertyName, 4) : $propertyName;
    }
}