<?php


namespace Api\Tool\Hydrator;


interface HydratorInterface
{

    public function hydrate(array $data, object $object): object;

}