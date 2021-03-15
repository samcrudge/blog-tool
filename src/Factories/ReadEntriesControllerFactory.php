<?php

namespace App\Factories;

use App\Controllers\ReadEntriesController;
use Psr\Container\ContainerInterface;

class ReadEntriesControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {

        $blogModel = $container->get('BlogModel');
        $renderer = $container->get('renderer');
        return $readEntriesController = new ReadEntriesController($blogModel, $renderer);

    }

}
