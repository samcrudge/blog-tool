<?php

namespace app\Db;

use PDO;

class DbConnection
{
    public function DbConnection()
    {
        return new PDO('mysql:host=127.0.0.1;dbname=blog-posts', 'root', 'password');
    }
}
