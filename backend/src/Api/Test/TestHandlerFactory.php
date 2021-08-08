<?php
declare(strict_types=1);

namespace Api\Test;

use Psr\Container\ContainerInterface;

class TestHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new TestHandler(
            $container
        );
    }
}
