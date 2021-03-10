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
        $ResponseData =
            [
                'success' => false,
                'message' => '',
                'data' => []
            ];

        $EditEntry = $request->getParsedBody();
        $Result = $this->BlogModel->editEntry($EditEntry);

        if ($Result)
        {
            $ResponseData['success'] = true;
            $ResponseData['message'] = "Your post has been successfully edited!";
            $ResponseData['data'] = $Result;
            return $this->respondWithJson($response->withHeader('Location', '/'), $ResponseData, 200);
        } else {

            $ResponseData['success'];
            $ResponseData['message'] = "Database cannot complete this task";
            $ResponseData['data'] = $Result;

            return $this->respondWithJson($response->withHeader('Location', '/'), $ResponseData, 500);
            print_r($BlogPost->errors());
        }
    }

}
