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
        $ResponseData =
            [
                'success' => false,
                'message' => '',
                'data' => []
            ];

        $AddNewEntry = $request->getParsedBody()['NewBlogEntry'] ?? null;

        if (!$AddNewEntry)
        {
            $ResponseData['message'] = "Please fill all fields";

            return $this->respondWithJson($response, $ResponseData, 500);
        }
    }

}
