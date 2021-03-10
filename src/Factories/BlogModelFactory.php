<?php

namespace App\Factories;

use App\Db\DbConnection;
use App\Models\BlogModel;
use Psr\Container\ContainerInterface;

class BlogModelFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $Db = $container->get('db')->DbConnection();
        $BlogModel = new BlogModel($Db);
        return $BlogModel;
    }

}
