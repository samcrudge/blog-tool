<?php


namespace App\Interfaces;


interface DbConnectInterface
{
    public function DbConnection(): \PDO;
}
