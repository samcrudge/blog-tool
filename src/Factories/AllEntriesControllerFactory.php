<?php

namespace App\Factories;

use App\Controllers\AllEntriesController;
use Psr\Container\ContainerInterface;

class AllEntriesControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $BlogModel = $container->get('BlogModel');
        $renderer = $container->get('renderer');
        $BlogModelPageController = new AllEntriesController($BlogModel, $renderer);
        return $BlogModelPageController;
    }

}