<?php

declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationRegistry;
use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

return [
    'dependencies' => [
        'factories' => [
            ValidatorInterface::class => function (ContainerInterface $container): ValidatorInterface {
                /** @psalm-suppress DeprecatedMethod */
                AnnotationRegistry::registerLoader('class_exists');

                return Validation::createValidatorBuilder()
                    ->enableAnnotationMapping()
                    ->getValidator();
            },
        ],
    ],
];
