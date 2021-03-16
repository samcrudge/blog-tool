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

        $newBlogPost = $request->getParsedBody();
        $validationObject = new Validator($newBlogPost);

        if (!Validators::validateNewPost($validationObject)) {
            $responseData['data'] = $validationObject->errors();

            return $this->respondWithJson($response, $responseData, 400);
        }

        $dbExchange = $this->blogModel->createNewEntry($newBlogPost);

        if ($dbExchange) {
            $responseData['success'] = true;
            $responseData['message'] = 'Your post has been successfully added to the database.';
            return $this->respondWithJson($response, $responseData, 200);
        }
        $responseData['message'] = "Something went wrong please try again.";
        return $this->respondWithJson($response, $responseData, 500);
    }
}
