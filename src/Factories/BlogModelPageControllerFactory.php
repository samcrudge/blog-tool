<?php

namespace App\Factories;

use App\Controllers\BlogModelPageController;
use Psr\Container\ContainerInterface;

class BlogModelPageControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $BlogModel = $container->get('BlogModel');
        $renderer = $container->get('renderer');
        $BlogModelPageController = new BlogModelPageController($BlogModel, $renderer);
        return $BlogModelPageController;
    }

}