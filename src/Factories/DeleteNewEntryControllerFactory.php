<?php

namespace App\Factories;

use App\Controllers\DeleteEntryController;
use Psr\Container\ContainerInterface;

class DeleteNewEntryControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $BlogModel = $container->get('BlogModel');
        $DeleteNewEntryController = new DeleteEntryController($BlogModel);
        return $DeleteNewEntryController;
    }

}