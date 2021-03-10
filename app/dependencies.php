<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

return function (ContainerBuilder $containerBuilder) {
    $container = [];

    $container[LoggerInterface::class] = function (ContainerInterface $c) {
        $settings = $c->get('settings');

        $loggerSettings = $settings['logger'];
        $logger = new Logger($loggerSettings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($handler);

        return $logger;
    };

    $container['renderer'] = function (ContainerInterface $c) {
        $settings = $c->get('settings')['renderer'];
        $renderer = new PhpRenderer($settings['template_path']);
        return $renderer;
    };

    $container['Db'] = new \App\Db\DbConnection();

    $container['BlogModel'] = DI\factory('App\Factories\BlogModelFactory');
    $container['AllEntriesController'] = DI\factory('App\Factories\AllEntriesController');
    $container['CreateNewEntryController'] = DI\factory('App\Factories\CreateNewEntryController');
    $container['EditEntryController'] = DI\factory('App\Factories\EditEntryController');
    $container['DeleteNewEntryController'] = DI\factory('App\Factories\DeleteNewEntryController');

    $containerBuilder->addDefinitions($container);
};
