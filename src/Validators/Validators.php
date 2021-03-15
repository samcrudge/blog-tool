<?php

namespace App\Validators;

use Exception;

class Validators {

    public static function ValidateNewPost($unvalidated) {
        $unvalidated->rule('required', ['title', 'author', 'date', 'post']);
        $unvalidated->rule('lengthMin', 'title', 1);
        $unvalidated->rule('lengthMin', 'author', 1);
        $unvalidated->rule('dateFormat', 'date', 'd-m-Y');
        $unvalidated->rule('lengthMin', 'post', 5);

        return $unvalidated->validate();
    }

    public static function ValidateEdit($unvalidated) {
        $unvalidated->rule('required', ['GUID', 'title', 'date', 'post']);
        $unvalidated->rule('lengthMin', 'post', 5);
        $unvalidated->rule('lengthMin', 'title', 1);
        $unvalidated->rule('lengthMin', 'author', 1);
        $unvalidated->rule('dateFormat', 'date', 'd-m-Y');

        if ($unvalidated->validate())
        {
            return $unvalidated;
        } else {
            throw new Exception('Please ensure all required fields are filled.');
        }
    }


}
