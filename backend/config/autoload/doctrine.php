<?php

declare(strict_types=1);

use Model\User\Type\EmailType;
use Model\User\Type\RoleType;
use Model\User\Type\StatusType;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\DBAL\Schema\AbstractAsset;
use Doctrine\DBAL\Types\Type;
use Doctrine\Functions\Rand;
use Doctrine\Functions\STDistanceSphere;
use Doctrine\Functions\STPoint;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;


return [
    'dependencies' => [
        'factories' => [
            EntityManagerInterface::class => function (ContainerInterface $container): EntityManagerInterface {
                $isDebug = $container->get('config')['debug'];

                $settings = $container->get('config')['doctrine'];

                $config = Setup::createAnnotationMetadataConfiguration(
                    $settings['model_dir'],
                    $isDebug,
                    $settings['proxy_dir'],
                    !$isDebug ? new FilesystemCache($settings['cache_dir']) : new ArrayCache(),
                    false
                );

                $config->setNamingStrategy(new UnderscoreNamingStrategy());

                $config->addCustomNumericFunction('rand', Rand::class);
                $config->addCustomStringFunction('ST_Distance_Sphere', STDistanceSphere::class);
                $config->addCustomStringFunction('POINT', STPoint::class);

                foreach ($settings['types'] as $name => $class) {
                    if (!Type::hasType($name)) {
                        Type::addType($name, $class);
                    }
                }

                $entityManager = EntityManager::create(
                    $settings['connection'],
                    $config
                );

                if (!empty($settings['diff_ignore_tables'])) {
                    $diffIgnoreTables = $settings['diff_ignore_tables'];
                    $entityManager->getConnection()->getConfiguration()->setSchemaAssetsFilter(static function ($assetName) use ($diffIgnoreTables) {
                        if ($assetName instanceof AbstractAsset) {
                            $assetName = $assetName->getName();
                        }

                        return !in_array($assetName, $diffIgnoreTables);
                    });
                }

                $entityManager->getConnection()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');

                return $entityManager;
            },
        ],
    ],

    'doctrine' => [
        'cache_dir'          => __DIR__ . '/../../db/cache',
        'proxy_dir'          => __DIR__ . '/../../db/proxies',
        'connection'         => [
            'driver'   => 'pdo_mysql',
            'user'     => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
            'dbname'   => getenv('DB_NAME'),
            'host'     => getenv('DB_HOST'),
//            'port'     => getenv('DB_PORT'),
            'charset'  => 'utf8mb4',
        ],
        'model_dir'          => [
            __DIR__ . '/../../src/Model/',
        ],
        'types' => [
            EmailType::NAME => EmailType::class,
            StatusType::NAME => StatusType::class,
            RoleType::NAME => RoleType::class
        ],

        'diff_ignore_tables' => [],
    ],
];
