<?php

namespace app\Db;

use PDO;

class dbConnection
{
    public function dbConnection()
    {
        return new PDO('mysql:host=127.0.0.1;dbname=blog-posts', 'root', 'password');
    }
}
