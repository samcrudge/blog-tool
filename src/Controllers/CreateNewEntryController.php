<?php

namespace App\Controllers;

use App\Abstracts\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CreateNewEntryController extends Controller
{
    private $BlogModel;

    /**
     * CreateNewEntryController constructor.
     * @param $BlogModel
     */
    public function __construct($BlogModel)
    {
        $this->BlogModel = $BlogModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $ResponseData =
            [
                'success' => false,
                'message' => '',
                'data' => []
            ];

        $BlogPost = new Valitron\Validator($_POST);
        $BlogPost->rule('required', ['title', 'author', 'date', 'post']);
        $BlogPost->rule('lengthMin', 'post', 5);
        $BlogPost->rule('lengthMin', 'title', 1);
        $BlogPost->rule('lengthMin', 'author', 1);
        $BlogPost->rule('date', 'date');

        if($BlogPost->validate()) {
            $this->BlogModel->CreateNewEntry($BlogPost);
            return $response->withStatus(200);
        } else {
            $ResponseData['message'] = "Please fill all fields";

            return $this->respondWithJson($response, $ResponseData, 400);
            print_r($BlogPost->errors());
        }
    }

}
