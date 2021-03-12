<?php

namespace App\Factories;

use App\Controllers\EditEntryController;
use Psr\Container\ContainerInterface;

class EditEntryControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $blogModel = $container->get('BlogModel');
        $editEntryController = new EditEntryController($blogModel);
        return $editEntryController;
    }

}
