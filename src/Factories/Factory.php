<?php

namespace App\Factories;

use Psr\Container\ContainerInterface;

class Factory
{
    public function __invoke(ContainerInterface $container)
    {
        $BlogModel = $container->get('BlogModel');
        $renderer = $container->get('renderer');
        $BlogModelPageController = new Factory($BlogModel, $renderer);
        return $BlogModelPageController;
    }

}