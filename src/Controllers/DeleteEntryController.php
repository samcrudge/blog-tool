<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteEntryController extends Controller
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
        $responseData =
            [
                'success' => false,
                'message' => '',
                'data' => []
            ];

        $blogPost = new Valitron\Validator($_POST);
        $blogPost->rule('required', ['GUID']);

        if ($blogPost->validate()) {
            $result = $this->blogModel->DeleteEntry($deletedEntry);
            if ($result) {
                $ResponseData['success'] = true;
                $ResponseData['message'] = "Your post has been successfully deleted!";
                $ResponseData['data'] = $Result;
                return $this->respondWithJson($response->withHeader('Location', '/'), $responseData, 200);
            } else {

                $responseData['success'];
                $responseData['message'] = "Database cannot complete this task to ".$result.".";

                print_r($blogPost->errors());
                return $this->respondWithJson($response->withHeader('Location', '/'), $responseData, 500);
            }
        }

    }

}
