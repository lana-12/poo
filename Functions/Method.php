<?php

namespace App\Functions;


class Method 
{

    /**
     * Display dump
     *
     * @param [type] $variable
     * @return void
     */
    public static function dump($variable)
    {
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
    }

    /**
     * Display date => format fr d/m/Y (20/01/2023)
     *
     * @param [type] $date
     * @return void
     */
    public static function dateFormat($date)
    {
        return date("d/m/Y", strtotime($date));
    }


    /**
     * Remove words and replace them with ...
     *
     * @param [type] $text
     * @param [type] $nbWord
     * @return void
     */
    public static function getWord($text, $nbWord)
    {
        // $nbWord = 10;
        $arrayWord = explode(' ', $text, $nbWord + 1);
        unset($arrayWord[$nbWord]);
        echo implode(' ', $arrayWord) . ' ...';
    }
}