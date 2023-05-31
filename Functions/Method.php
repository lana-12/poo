<?php

namespace App\Functions;


class Method 
{

    
    public static function dump($variable)
    {
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
    }

    public static function dateFormat($date)
    {
        return date("d/m/Y", strtotime($date));
    }

    public static function getWord($text, $nbWord)
    {
        // $nbWord = 10;
        $arrayWord = explode(' ', $text, $nbWord + 1);
        unset($arrayWord[$nbWord]);
        echo implode(' ', $arrayWord) . ' ...';
    }
}