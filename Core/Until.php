<?php

/**
 * Class Until
 * this class provide some static common method
 */
class Until
{
    /**
     * @param $string
     * @return array
     * Return number in a string
     */
    static public function getNumInString($string){
        $regex = "/[0-3]/" ;
        preg_match_all($regex,$string,$match) ;
        $data = array_unique($match[0] );
        return $data ;
    }

    /**
     * @return false|string
     * Get current time
     */
    static public function getCurrentDateTime(){
        return date("Y-m-d H:i:s");
    }
}