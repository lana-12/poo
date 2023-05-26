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



}