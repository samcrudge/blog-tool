<?php

namespace App\Interfaces;

use Valitron\Validator;

interface ValidationInterface
{
    public static function validateNewPost(Validator $validationObject): bool;
    public static function validateUpdate(Validator $unvalidated): bool;
    public static function validateDelete(Validator $unvalidated): bool;
}
