<?php

namespace App\Controllers;

use App\Abstracts\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CreateNewEntryController extends Controller
{
    private $BlogModel;

    /**
     * CreateNewEntryController constructor.
     * @param $BlogModel
     */
    public function __construct($BlogModel)
    {
        $this->BlogModel = $BlogModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $AddNewEntry = $request->getParsedBody();
        $result = $AddNewEntry['NewBlogEntry'];
        if ($result === true)
        {
            $DbResult = $this->BlogModel->createNewEntry($AddNewEntry);
        }
        return $response->withHeader('location', '/');
    }

}
