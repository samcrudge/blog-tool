<?php

namespace App\Controllers;

use App\Abstracts\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CreateNewEntryController extends Controller
{
    private $blogModel;

    /**
     * CreateNewEntryController constructor.
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
        $blogPost->rule('required', ['title', 'author', 'date', 'post']);
        $blogPost->rule('lengthMin', 'post', 5);
        $blogPost->rule('lengthMin', 'title', 1);
        $blogPost->rule('lengthMin', 'author', 1);
        $blogPost->rule('date', 'date');

        if($blogPost->validate()) {

            $result = $this->blogModel->CreateNewEntry($blogPost);

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

            print_r($blogPost->errors());
            return $this->respondWithJson($response, $responseData, 500);
        }
    }

}
