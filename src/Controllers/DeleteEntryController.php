<?php

namespace App\Controllers;

use App\Abstracts\Controller;

use App\Validators\PostValidation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Valitron\Validator;

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

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $responseData =
            [
                'success' => false,
                'message' => '',
                'data' => []
            ];

        $blogPostGuid = $request->getParsedBody();
        $validationObject = new Validator($blogPostGuid);

        if (!PostValidation::validateDelete($validationObject)) {
            $responseData['message'] = 'Your post does not meet requirements';
            $responseData['data'] = $validationObject->errors();
            return $this->respondWithJson($response, $responseData, 400);
        }

        $queryResult = $this->blogModel->deleteEntry($blogPostGuid);

        if ($queryResult) {
            $responseData['success'] = true;
            $responseData['message'] = "Your post has been successfully deleted!";
            $responseData['data'] = $blogPostGuid;
            return $this->respondWithJson($response, $responseData, 200);
        }
        $responseData['message'] = "Something went wrong please try again.";
        $responseData['data'] = $validationObject;
        return $this->respondWithJson($response, $responseData, 500);
    }
}
