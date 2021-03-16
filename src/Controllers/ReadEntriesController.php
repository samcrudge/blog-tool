<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class ReadEntriesController extends Controller
{
    private $blogModel;
    private $renderer;

    /**
     * ReadEntriesController constructor.
     * @param $blogModel
     * @param $renderer
     */
    public function __construct($blogModel, PhpRenderer $renderer)
    {
        $this->blogModel = $blogModel;
        $this->renderer = $renderer;
    }


    public function __invoke(Request $request, Response $response, array $args)
    {
        $responseData =
            [
                'success' => false,
                'message' => '',
                'data' => []
            ];

        $readAllPosts = $this->blogModel->ReadAllEntries();

        if ($readAllPosts) {
            $responseData['success'] = true;
            $responseData['message'] = "Your post has been successfully saved!";
            return $this->respondWithJson($response, $readAllPosts, 200);
        }
        $responseData['message'] = "Something went wrong please try again.";
        return $this->respondWithJson($response, $responseData, 500);
    }
}
