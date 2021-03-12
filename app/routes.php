<?php
declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function ($request, $response, $args) use ($container) {
        $renderer = $container->get('renderer');
        return $renderer->render($response, "index.php", $args);
    });

    #working
    $app->get('/all', 'AllEntriesController');

    #working on
    $app->post('/new', 'CreateNewEntryController');

    #ToDo
    $app->post('/edit', 'EditEntryController');
    $app->post('/delete', 'DeleteEntryController');

};
