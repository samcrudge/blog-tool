<?php

namespace App\Validators;

use App\Interfaces\ValidationInterface;
use Valitron\Validator;

class PostValidation implements ValidationInterface
{
    public static function validateNewPost(Validator $validationObject): bool
    {
        $validationObject->rule('required', ['title', 'author', 'date', 'post']);
        self::titleRule($validationObject);
        self::dateRule($validationObject);
        self::postRule($validationObject);
        $validationObject->rule('lengthMin', 'author', 1);
        return $validationObject->validate();
    }

    public static function validateUpdate(Validator $validationObject): bool
    {
        $validationObject->rule('required', ['GUID', 'title', 'date', 'post']);
        self::titleRule($validationObject);
        self::dateRule($validationObject);
        self::postRule($validationObject);
        return $validationObject->validate();
    }

    public static function validateDelete(Validator $validationObject): bool
    {
        $validationObject->rule('required', ['GUID']);

        return $validationObject->validate();
    }

    private static function titleRule($validationObject)
    {
        return $validationObject->rule('lengthMin', 'title', 1);
    }

    private static function dateRule($validationObject)
    {
        return $validationObject->rule('dateFormat', 'date', 'd-m-Y');
    }

    private static function postRule($validationObject)
    {
        return $validationObject->rule('lengthMin', 'post', 5);
    }
}
