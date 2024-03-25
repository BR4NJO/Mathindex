<?php

namespace App\Trait;

trait ObjsToArrayTrait
{
    public function ObjsToArray($objs) {
        return array_map(function ($obj) {
            $reflection = new \ReflectionClass($obj);
            $properties = [];
            foreach ($reflection->getProperties() as $property) {
                $property->setAccessible(true);
                $properties[$property->getName()] = $property->getValue($obj);
            }
            return $properties;
        }, $objs);
    }
}