<?php

declare(strict_types=1);

use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Doctrine\Migrations;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

(function () {
    /** @var ContainerInterface $container */
    $container = require __DIR__ . '/../config/container.php';

    $cli = new Application('Console:\n');

    $commands = $container->get('config')['console']['commands'] ?? [];

    $commands[] = ValidateSchemaCommand::class;
    $commands[] = GenerateProxiesCommand::class;
    $commands[] = Migrations\Tools\Console\Command\ExecuteCommand::class;
    $commands[] = Migrations\Tools\Console\Command\MigrateCommand::class;
    $commands[] = Migrations\Tools\Console\Command\LatestCommand::class;
    $commands[] = Migrations\Tools\Console\Command\StatusCommand::class;
    $commands[] = Migrations\Tools\Console\Command\UpToDateCommand::class;
    $commands[] = Migrations\Tools\Console\Command\DiffCommand::class;
    $commands[] = Migrations\Tools\Console\Command\GenerateCommand::class;
    $commands[] = Migrations\Tools\Console\Command\DumpSchemaCommand::class;
    $commands[] = Migrations\Tools\Console\Command\VersionCommand::class;

    /** @var EntityManagerInterface $entityManager */
    $entityManager = $container->get(EntityManagerInterface::class);
    $connection = $entityManager->getConnection();

    $configuration = new Configuration($connection);
    $configuration->setMigrationsDirectory(__DIR__ . '/../db/migrations');
    $configuration->setMigrationsNamespace('Migrations');
    $configuration->setMigrationsTableName('migrations');
    $configuration->setAllOrNothing(true);
    $configuration->setCheckDatabasePlatform(false);

    $cli->getHelperSet()->set(new EntityManagerHelper($entityManager), 'em');
    $cli->getHelperSet()->set(new ConfigurationHelper($connection, $configuration), 'configuration');

    foreach ($commands as $commandName => $commandClass) {
        /** @var Command $command */
        $command = $container->get($commandClass);
        $cli->add($command);
    }

    $cli->run();
})();