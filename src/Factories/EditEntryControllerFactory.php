<?php

namespace App\Factories;

use App\Controllers\EditEntryController;
use Psr\Container\ContainerInterface;

class EditEntryControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $BlogModel = $container->get('BlogModel');
        $EditEntryController = new EditEntryController($BlogModel);
        return $EditEntryController;
    }

}