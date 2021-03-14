<?php

namespace App\Controllers;

use App\Abstracts\Controller;

use App\Validators\Validators;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use throwable;


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

        $blogPost = new Valitron\Validator($_POST);

        try {
            Validators::ValidateNewPost($blogPost);
        } catch (throwable $e) {
            $responseData['success'];
            $responseData['message'] = $e->getMessage();

            return $this->respondWithJson($response, $responseData, 500);
        }
        $result = $this->blogModel->CreateNewEntry($blogPost);
        $responseData['success'] = true;
        $responseData['message'] = "Your post has been successfully saved!";
        $responseData['data'] = $result;
        try {
            return $this->respondWithJson($response, $responseData, 200);
        } catch (\Exception $e) {
            $responseData['success'];
            $responseData['message'] = $e->getMessage();

            return $this->respondWithJson($response, $responseData, 500);
        }
    }
}
