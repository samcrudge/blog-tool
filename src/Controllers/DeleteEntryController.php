<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteEntryController extends Controller
{
    private $BlogModel;

    /**
     * deleteEntryController constructor.
     * @param $BlogModel
     */
    public function __construct($BlogModel)
    {
        $this->BlogModel = $BlogModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $DeletedEntry = $request->getParsedBody();
        $DbResult = $this->BlogModel->DeleteEntry($DeletedEntry);
        return $response->withHeader('Location', '/');
    }

}
