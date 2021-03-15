<?php

namespace App\Factories;

use App\Controllers\CreateNewEntryController;
use Psr\Container\ContainerInterface;

class CreateNewEntryControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $blogModel = $container->get('BlogModelInstanceInterface');
        return $createNewEntryController = new CreateNewEntryController($blogModel);
    }
}
