<?php

declare(strict_types=1);

namespace Console;

class ConfigProvider
{

    public function __invoke(): array
    {
        return [
            'console' => [
                'commands' => $this->getCommands(),
            ],
        ];
    }

    protected function getCommands(): array
    {
        return [
            AddLinksCommand::NAME       => AddLinksCommand::class
        ];
    }
}
