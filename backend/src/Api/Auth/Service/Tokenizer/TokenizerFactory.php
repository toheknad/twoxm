<?php

declare(strict_types=1);

namespace Api\Auth\Service\Tokenizer;

use DateInterval;
use Interop\Container\ContainerInterface;

class TokenizerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Tokenizer(
            new DateInterval(getenv("TOKENIZER_TTL"))
        );
    }
}
