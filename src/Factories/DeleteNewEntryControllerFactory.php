<?php

namespace App\Factories;

use App\Controllers\DeleteEntryController;
use Psr\Container\ContainerInterface;

class DeleteNewEntryControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $blogModel = $container->get('blogModel');
        $deleteNewEntryController = new DeleteEntryController($blogModel);
        return $deleteNewEntryController;
    }

}