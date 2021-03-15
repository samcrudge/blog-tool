<?php

namespace App\Factories;

use App\Db\DbConnection;
use App\Models\BlogModel;
use Psr\Container\ContainerInterface;

class BlogModelFactory
{
    public function __invoke(ContainerInterface $container)
    {

        $db = $container->get('db')->DbConnection();
        return $blogModel = new BlogModel($db);

    }

}
