<?php

namespace App\Validators;




class Validators {

    private static function ValidateEdit($unvalidated) {
        $unvalidated->rule('required', ['title', 'author', 'date', 'post', 'GUID']);
        $unvalidated->rule('lengthMin', 'post', 5);
        $unvalidated->rule('lengthMin', 'title', 1);
        $unvalidated->rule('lengthMin', 'author', 1);
        $unvalidated->rule('date', 'date');

        if ($unvalidated->validate())
        {
            return $unvalidated;
        } else {
            throw new \Exception('Please ensure all required fields are filled.');
        }
    }

    public static function ValidateNewPost($unvalidated) {
        $unvalidated->rule('required', ['title', 'author', 'date', 'post']);
        $unvalidated->rule('lengthMin', 'post', 5);
        $unvalidated->rule('lengthMin', 'title', 1);
        $unvalidated->rule('lengthMin', 'author', 1);
        $unvalidated->rule('date', 'date');

        if ($unvalidated->validate())
        {
            return $unvalidated;
        } else {
            throw new \Exception('Please ensure all required fields are filled.');
        }
    }
}
