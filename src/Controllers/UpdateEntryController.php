<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Validators\Validators;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Valitron\Validator;

class UpdateEntryController extends Controller
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

        $updatedBlogPost = $request->getParsedBody();
        $validationObject = new Validator($updatedBlogPost);

        if (!Validators::validateUpdate($validationObject)) {
            $responseData['message'] = 'Your post does not meet requirements';
            $responseData['data'] = $validationObject->errors();
            return $this->respondWithJson($response, $responseData, 400);
        }

        $dbExchange = $this->blogModel->updateEntry($updatedBlogPost);

        if ($dbExchange) {
            $responseData['success'] = true;
            $responseData['message'] = "Your post has been successfully saved!";
            $responseData['data'] = $updatedBlogPost;
            return $this->respondWithJson($response, $responseData, 200);
        }
        $responseData['message'] = "Something went wrong please try again.";
        $responseData['data'] = $validationObject;

        return $this->respondWithJson($response, $responseData, 500);
    }
}
