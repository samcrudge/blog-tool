<?php

namespace App\Factories;

use App\Controllers\DeleteEntryController;
use Psr\Container\ContainerInterface;

class DeleteEntryControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $blogModel = $container->get('BlogModelInstanceInterface');
        return $deleteEntryController = new DeleteEntryController($blogModel);
    }
}
