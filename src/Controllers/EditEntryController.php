<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EditEntryController extends Controller
{
    private $BlogModel;

    /**
     * editEntryController constructor.
     * @param $BlogModel
     */
    public function __construct($BlogModel)
    {
        $this->BlogModel = $BlogModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $EditEntry = $request->getParsedBody();
        $DbResult = $this->BlogModel->editEntry($EditEntry);
        return $response->withHeader('location', '/');
    }

}
