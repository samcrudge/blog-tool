<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EditEntryController extends Controller
{
    private $BlogModel;

    /**
     * editEntryController constructor.
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
        $BlogPost->rule('required', ['GUID']);

        if($BlogPost->validate()) {

            $Result = $this->BlogModel->EditEntry($BlogPost);

            if ($Result) {

                $ResponseData['success'] = true;
                $ResponseData['message'] = "Your post has been successfully saved!";
                $ResponseData['data'] = $Result;
                return $this->respondWithJson($response, $ResponseData, 200);
            }
        } else {

            $ResponseData['success'];
            $ResponseData['message'] = "Please fill all fields";
            $ResponseData['data'] = $BlogPost;

            print_r($BlogPost->errors());
            return $this->respondWithJson($response, $ResponseData, 500);
        }
    }

}
