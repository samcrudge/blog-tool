<?php

namespace App\Interfaces;

interface ValidationInterface
{
    public static function validateNewPost($unvalidated);
    public static function validateUpdate($unvalidated);
    public static function validateDelete($unvalidated);
}
