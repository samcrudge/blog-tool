<?php


namespace App\Interfaces;


interface ValidationInterface
{
    public static function ValidateNewPost($unvalidated);
    public static function ValidateUpdate($unvalidated);
    public static function ValidateDelete($unvalidated);
}
