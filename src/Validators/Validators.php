<?php

namespace App\Validators;

use App\Interfaces\ValidationInterface;
use Exception;
use Valitron\Validator;

class Validators implements ValidationInterface
{
    public static function validateNewPost($validationObject)
    {
        $validation = new Validator($validationObject);
        $validation->rule('required', ['title', 'author', 'date', 'post']);
        $validation->rule('lengthMin', 'title', 1);
        $validation->rule('lengthMin', 'author', 1);
        $validation->rule('dateFormat', 'date', 'd-m-Y');
        $validation->rule('lengthMin', 'post', 5);
        if ($validation->validate()) {
            return $validation;
        } else {
            throw new Exception('Please ensure all required fields are filled and meet requirements.');
        }
    }

    public static function validateUpdate($validationObject)
    {
        $validationObject->rule('required', ['GUID', 'title', 'date', 'post']);
        $validationObject->rule('lengthMin', 'post', 5);
        $validationObject->rule('lengthMin', 'title', 1);
        $validationObject->rule('lengthMin', 'author', 1);
        $validationObject->rule('dateFormat', 'date', 'd-m-Y');

        if ($validationObject->validate()) {
            return $validationObject;


        }
        throw new Exception('Please ensure all required fields are filled and meet requirements.');
    }

    public static function validateDelete($validationObject)
    {
        $validationObject->rule('required', ['GUID']);
        if ($validationObject->validate()) {
            return $validationObject;
        }
        throw new Exception('Please ensure a post has been selected.');
    }
}
