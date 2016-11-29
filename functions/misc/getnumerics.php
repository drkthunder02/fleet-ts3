<?php

function GetNumbers($str) {
    $result = '';
    //Get the numerics from the string and store by reference into result
    preg_match_all('/\d+/', $str, $result);
    //Pass the first part of the result array back to the caller    
    return $result[0];
}