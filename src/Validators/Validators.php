<?php

namespace App\Validators;

use App\Interfaces\ValidationInterface;
use Exception;

class Validators implements ValidationInterface
{

    public static function ValidateNewPost($unvalidated): array
    {
        $unvalidated->rule('required', ['title', 'author', 'date', 'post']);
        $unvalidated->rule('lengthMin', 'title', 1);
        $unvalidated->rule('lengthMin', 'author', 1);
        $unvalidated->rule('dateFormat', 'date', 'd-m-Y');
        $unvalidated->rule('lengthMin', 'post', 5);
        if ($unvalidated->validate()) {
            return $unvalidated;
        } else {
            throw new Exception('Please ensure all required fields are filled and meet requirements.');
        }
    }

    public static function ValidateUpdate($unvalidated)
    {
        $unvalidated->rule('required', ['GUID', 'title', 'date', 'post']);
        $unvalidated->rule('lengthMin', 'post', 5);
        $unvalidated->rule('lengthMin', 'title', 1);
        $unvalidated->rule('lengthMin', 'author', 1);
        $unvalidated->rule('dateFormat', 'date', 'd-m-Y');

        if ($unvalidated->validate()) {
            return $unvalidated;


        }
        throw new Exception('Please ensure all required fields are filled and meet requirements.');
    }
    public static function ValidateDelete($unvalidated)
    {
        $unvalidated->rule('required', ['GUID']);
        if ($unvalidated->validate()) {
            return $unvalidated;
        }
        throw new Exception('Please ensure a post has been selected.');
    }
}
