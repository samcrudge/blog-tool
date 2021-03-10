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
        $ResponseData =
            [
                'success' => false,
                'message' => '',
                'data' => []
            ];

        $BlogPost = new Valitron\Validator($_POST);
        $BlogPost->rule('required', ['title', 'author', 'date', 'post']);
        if ($BlogPost->validate()) {
            $BlogPost = $this->BlogModel->DeleteEntry($DeletedEntry);
            if ($Result) {
                $ResponseData['success'] = true;
                $ResponseData['message'] = "Your post has been successfully deleted!";
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

}
