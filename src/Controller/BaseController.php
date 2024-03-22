<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController {
    public static function ObjsToArray($objs) {
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