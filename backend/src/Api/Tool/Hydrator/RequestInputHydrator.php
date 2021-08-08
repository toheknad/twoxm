<?php


namespace Api\Tool\Hydrator;


use Laminas\Hydrator\ReflectionHydrator;

class RequestInputHydrator implements HydratorInterface
{

    public function hydrate(array $data, object $object): object
    {
        $hydrator = new ReflectionHydrator();
        $hydrator->hydrate($data, $object);
        return $object;
    }
}