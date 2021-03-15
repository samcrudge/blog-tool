<?php


namespace App\Interfaces;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

interface BlogModelInstanceInterface
{
    public function __construct(BlogModelInstanceInterface $blogModel);
}
