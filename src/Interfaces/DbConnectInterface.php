<?php

namespace App\Interfaces;

interface DbConnectInterface
{
    public function dbConnection(): \PDO;
}
