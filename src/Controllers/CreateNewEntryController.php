<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Validators\PostValidation;
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

        $newBlogPost = $request->getParsedBody();
        $validationObject = new Validator($newBlogPost);

        if (!PostValidation::validateNewPost($validationObject)) {
            $responseData['data'] = $validationObject->errors();

            return $this->respondWithJson($response, $responseData, 400);
        }

        $queryResult = $this->blogModel->createNewEntry($newBlogPost);

        if ($queryResult) {
            $responseData['success'] = true;
            $responseData['message'] = 'Your post has been successfully added to the database.';
            $responseData['data'] = $newBlogPost;
            return $this->respondWithJson($response, $responseData, 200);
        }
        $responseData['message'] = "Something went wrong please try again.";
        return $this->respondWithJson($response, $responseData, 500);
    }
}
