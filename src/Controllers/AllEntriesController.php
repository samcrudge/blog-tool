<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class AllEntriesController extends Controller
{
    private $blogModel;
    private $renderer;

    /**
     * AllEntriesController constructor.
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
                'message' => ''
            ];

        $blogData = $this->blogModel->GetAllEntries();

        if($blogData){

            return $this->respondWithJson($response, $blogData, 200);
        } else {

            $responseData['message'] = 'Problem with DB';
            return $this->respondWithJson($response, $responseData, 500);
        }

    }


}
