<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {

    $app->addBodyParsingMiddleware();

    $app->get('/', 'ReadEntriesController');
    $app->post('/create', 'CreateNewEntryController');
    $app->put('/update', 'UpdateEntryController');
    $app->delete('/delete', 'DeleteEntryController');

};
