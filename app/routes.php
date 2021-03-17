<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {

    $app->addBodyParsingMiddleware();

    $app->post('/create', 'CreateNewEntryController');
    $app->get('/read', 'ReadEntriesController');
    $app->put('/update', 'UpdateEntryController');
    $app->delete('/delete', 'DeleteEntryController');

};
