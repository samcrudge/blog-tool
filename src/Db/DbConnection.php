<?php

namespace App\Db;

use PDO;

class DbConnection
{
    public function DbConnection(): \PDO
    {
        $db = new \PDO('mysql:host=127.0.0.1:3306;dbname=blog-tool', 'root', 'password');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $db;
    }
}
