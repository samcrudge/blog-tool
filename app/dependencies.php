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

    $container['db'] = new App\Db\DbConnection();

    $container['BlogModelInstanceInterface'] = DI\factory('App\Factories\BlogModelFactory');
    $container['CreateNewEntryController'] = DI\factory('App\Factories\CreateNewEntryControllerFactory');
    $container['ReadEntriesController'] = DI\factory('App\Factories\ReadEntriesControllerFactory');
    $container['UpdateEntryController'] = DI\factory('App\Factories\UpdateEntryControllerFactory');
    $container['DeleteEntryController'] = DI\factory('App\Factories\DeleteEntryControllerFactory');

    $containerBuilder->addDefinitions($container);
};
