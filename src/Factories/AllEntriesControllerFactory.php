<?php

namespace App\Factories;

use App\Controllers\AllEntriesController;
use Psr\Container\ContainerInterface;

class AllEntriesControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $blogModel = $container->get('blogModel');
        $renderer = $container->get('renderer');
        $blogModelPageController = new AllEntriesController($blogModel, $renderer);
        return $blogModelPageController;
    }

}
