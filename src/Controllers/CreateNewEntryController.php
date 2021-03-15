<?php

namespace App\Controllers;

use App\Abstracts\Controller;

use App\Interfaces\BlogModelInstanceInterface;
use App\Validators\Validators;
use phpDocumentor\Reflection\Types\Object_;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Valitron\Validator;


class CreateNewEntryController extends Controller implements BlogModelInstanceInterface
{
    private BlogModelInstanceInterface $blogModel;

    /**
     * editEntryController constructor.
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

        $newBlogPost = $request->getParsedBody();
        $blogPost = new Validator($newBlogPost);

            if(!Validators::ValidateNewPost($blogPost)) {
                $responseData['success'];
                $responseData['data'] = $blogPost->errors();

                return $this->respondWithJson($response, $responseData, 500);
            }

        $dbExchange = $this->blogModel->CreateNewEntry($newBlogPost);

            if($dbExchange){
                $responseData['success'] = true;
                $responseData['message'] = 'Your post has been successfully added to the database.';
                return $this->respondWithJson($response, $responseData, 200);
            }

        $responseData['success'];
        $responseData['message'] = "Something went wrong";
        return $this->respondWithJson($response, $responseData, 500);
    }
}
