<?php

namespace App\Validators;




class Validators {

    private static function validateInput($editEntry) {
        $editEntry->rule('required', ['title', 'author', 'date', 'post', 'GUID']);
        $editEntry->rule('lengthMin', 'post', 5);
        $editEntry->rule('lengthMin', 'title', 1);
        $editEntry->rule('lengthMin', 'author', 1);
        $editEntry->rule('date', 'date');

        if ($editEntry->validate())
        {
            return $editEntry;
        } else {
            throw new \Exception('Please ensure all required fields are filled.');
        }
    }
}
