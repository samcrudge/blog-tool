<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class deleteEntryController extends Controller
{
    private $blogModel;

    /**
     * deleteEntryController constructor.
     * @param $blogModel
     */
    public function __construct($blogModel)
    {
        $this->blogModel = $blogModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $deletedEntry = $request->getParsedBody();
        $result = $deletedEntry['deleteEntry'];
        if ($result == true)
        {
            $dbResult = $this->blogModel->deleteEntry($deletedEntry);
        }
    }

}