<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Interfaces\BlogModelInstanceInterface;
use App\Validators\Validators;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Valitron\Validator;

class DeleteEntryController extends Controller implements BlogModelInstanceInterface
{
    private BlogModelInstanceInterface $blogModel;

    /**
     * deleteEntryController constructor.
     * @param $blogModel
     */
    public function __construct(BlogModelInstanceInterface $blogModel)
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

        if (!Validators::validateDelete($validationObject)) {
            $responseData['message'] = 'Your post does not meet requirements';
            $responseData['data'] = $validationObject->errors();
            return $this->respondWithJson($response, $responseData, 400);
        }

        $dbExchange = $this->blogModel->deleteEntry($blogPostGuid);

        if ($dbExchange) {
            $responseData['success'] = true;
            $responseData['message'] = "Your post has been successfully saved!";
            $responseData['data'] = $blogPostGuid;
            return $this->respondWithJson($response, $responseData, 200);
        }
        $responseData['message'] = "something went wrong";
        $responseData['data'] = $validationObject;
        return $this->respondWithJson($response, $responseData, 500);
    }
}
