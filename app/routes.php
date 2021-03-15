<?php
declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $container = $app->getContainer();
    $app->addBodyParsingMiddleware();
    $app->get('/', function ($request, $response, $args) use ($container) {
        $renderer = $container->get('renderer');
        return $renderer->render($response, "index.php", $args);
    });

    #working
    $app->get('/all', 'AllEntriesController');
    $app->post('/new', 'CreateNewEntryController');

    #working-on
    $app->put('/edit', 'EditEntryController');

    #todo
    $app->post('/delete', 'DeleteEntryController');

};
