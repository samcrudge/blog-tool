<?php

namespace App\Factories;

use App\Controllers\CreateNewEntryController;
use Psr\Container\ContainerInterface;

class CreateNewEntryControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $BlogModel = $container->get('BlogModel');
        $CreateNewEntryController = new CreateNewEntryController($BlogModel);
        return $CreateNewEntryController;
    }

}