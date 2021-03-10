<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EditEntryController extends Controller
{
    private $blogModel;

    /**
     * editEntryController constructor.
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

        if($blogPost->validate()) {

            $result = $this->blogModel->EditEntry($blogPost);

            if ($result) {

                $responseData['success'] = true;
                $responseData['message'] = "Your post has been successfully saved!";
                $responseData['data'] = $result;
                return $this->respondWithJson($response, $responseData, 200);
            }
        } else {

            $responseData['success'];
            $responseData['message'] = "Please fill all fields";
            $responseData['data'] = $blogPost;

            return $this->respondWithJson($response, $responseData, 500);
        }
    }

}
