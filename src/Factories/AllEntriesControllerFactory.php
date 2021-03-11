<?php

namespace App\Factories;

use App\Controllers\AllEntriesController;
use Psr\Container\ContainerInterface;

class AllEntriesControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $blogModel = $container->get('BlogModel');
        $renderer = $container->get('renderer');
        $allEntriesController = new AllEntriesController($blogModel, $renderer);
        return $allEntriesController;
    }

}
