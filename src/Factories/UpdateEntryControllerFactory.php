<?php

namespace App\Factories;

use App\Controllers\UpdateEntryController;
use Psr\Container\ContainerInterface;

class UpdateEntryControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $blogModel = $container->get('BlogModelInstanceInterface');
        return $updateEntryController = new UpdateEntryController($blogModel);
    }
}
