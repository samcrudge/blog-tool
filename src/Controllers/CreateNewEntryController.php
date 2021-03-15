<?php

namespace App\Controllers;

use App\Abstracts\Controller;

use App\Validators\Validators;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Valitron\Validator;


class CreateNewEntryController extends Controller
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

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $responseData =
            [
                'success' => false,
                'message' => '',
                'data' => []
            ];
        $blogDataPost = $request->getParsedBody();
        $blogPost = new Validator($blogDataPost);

            if(!Validators::ValidateNewPost($blogPost)) {
                $responseData['success'];
                $responseData['message'] = 'Your post does not meet requirements';
                $responseData['data'] = $blogPost->errors();

                return $this->respondWithJson($response, $responseData, 500);
            }
        $result = $this->blogModel->CreateNewEntry($blogDataPost);
            if($result){
                $responseData['success'] = true;
                $responseData['message'] = 'Your post has been successfully added!';
                $responseData['data'] = $result;

            return $this->respondWithJson($response, $responseData, 200);
        }
        $responseData['success'];
        $responseData['message'] = "something went wrong";

        return $this->respondWithJson($response, $responseData, 500);
    }
}
