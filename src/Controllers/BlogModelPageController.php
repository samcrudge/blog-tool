<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class BlogModelPageController extends Controller
{
    private $BlogModel;
    private $Renderer;

    /**
     * BlogModelPageController constructor.
     * @param $BlogModel
     * @param $Renderer
     */
    public function __construct($BlogModel, PhpRenderer $Renderer)
    {
        $this->BlogModel = $BlogModel;
        $this->Renderer = $Renderer;
    }


    public function __invoke(Request $request, Response $response, array $args)
    {
        $Data = ['AllBlogs'] = $this->BlogModel->GetAllEntries();
        return $this->Renderer->render($response, '/', $Data);
    }


}
