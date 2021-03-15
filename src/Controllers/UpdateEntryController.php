<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Interfaces\BlogModelInstanceInterface;
use App\Validators\Validators;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Valitron\Validator;

class UpdateEntryController extends Controllerv implements BlogModelInstanceInterface
{
    private BlogModelInstanceInterface $blogModel;

    /**
     * editEntryController constructor.
     * @param BlogModelInstanceInterface $blogModel
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

        $updatedBlogPost = $request->getParsedBody();
        $blogPost = new Validator($updatedBlogPost);

        if (!Validators::ValidateUpdate($blogPost)) {

            $responseData['success'];
            $responseData['message'] = 'Your post does not meet requirements';
            $responseData['data'] = $blogPost->errors();
            return $this->respondWithJson($response, $responseData, 500);

        }

        $dbExchange = $this->blogModel->UpdateEntry($updatedBlogPost);

        if ($dbExchange) {

            $responseData['success'] = true;
            $responseData['message'] = "Your post has been successfully saved!";
            $responseData['data'] = $updatedBlogPost;
            return $this->respondWithJson($response, $responseData, 200);

        }

        $responseData['success'];
        $responseData['message'] = "something went wrong";
        $responseData['data'] = $blogPost;

        return $this->respondWithJson($response, $responseData, 500);
    }

}
