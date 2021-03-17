<?php

namespace App\Validators;

use App\Interfaces\ValidationInterface;
use Valitron\Validator;

class PostValidation implements ValidationInterface
{
    public static function validateNewPost(Validator $validationObject): bool
    {
        $validationObject->rule('required', ['title', 'author', 'date', 'post']);
        $validationObject->rule('lengthMin', 'title', 1);
        $validationObject->rule('lengthMin', 'author', 1);
        $validationObject->rule('dateFormat', 'date', 'd-m-Y');
        $validationObject->rule('lengthMin', 'post', 5);

        return $validationObject->validate();
    }

    public static function validateUpdate(Validator $validationObject): bool
    {
        $validationObject->rule('required', ['GUID', 'title', 'date', 'post']);
        $validationObject->rule('lengthMin', 'post', 5);
        $validationObject->rule('lengthMin', 'title', 1);
        $validationObject->rule('lengthMin', 'author', 1);
        $validationObject->rule('dateFormat', 'date', 'd-m-Y');

        return $validationObject->validate();
    }

    public static function validateDelete(Validator $validationObject): bool
    {
        $validationObject->rule('required', ['GUID']);

        return $validationObject->validate();
    }
}
