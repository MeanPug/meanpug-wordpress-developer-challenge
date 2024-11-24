<?php

/**
 * Support: Button Group field helpers
 * If you copied your fields correctly, you should have the correct setup which is a support field containing an alignment selection and button repeater
 * Each module should have a clone of that field in a group with an appropriate name - default is cta
 */
class MeanpugTestRandString{

    public static function generate ($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
	
}
