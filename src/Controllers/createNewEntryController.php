<?php

namespace App\Controllers;

use App\Abstracts\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class createNewEntryController extends Controller
{
    private $blogModel;

    /**
     * createNewEntryController constructor.
     * @param $blogModel
     */
    public function __construct($blogModel)
    {
        $this->blogModel = $blogModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $addNewEntry = $request->getParsedBody();
        $result = $addNewEntry['newBlogEntry'];
        if ($result == true)
        {
            $dbResult = $this->blogModel->createNewEntry($addNewEntry);
        }
        return $response->withHeader('location', '/');
    }

}