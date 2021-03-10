<?php

namespace App\Factories;

use App\Db\DbConnection;
use App\Models\BlogModel;
use Psr\Container\ContainerInterface;

class BlogModelFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $bb = $container->get('db')->DbConnection();
        $blogModel = new BlogModel($db);
        return $blogModel;
    }

}
