<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilities
{
    public function slugify($string, $slug_string = "_")
    {
        $new_string = strtolower($string);
        $new_string = str_replace(" ", $slug_string, $new_string);

        return $new_string;
    }
}