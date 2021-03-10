<?php

namespace App\Factories;

use Psr\Container\ContainerInterface;

class BlogModelPageControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $BlogModel = $container->get('BlogModel');
        $renderer = $container->get('renderer');
        $BlogModelPageController = new BlogModelPageControllerFactory($BlogModel, $renderer);
        return $BlogModelPageController;
    }

}