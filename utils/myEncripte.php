<?php

function myEncrypte($param, $type) {
    if ($type == "str") {
        return filter_var($param, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    
    if ($type == "mail") {
        return filter_var($param, FILTER_SANITIZE_EMAIL);
    }
    
    if ($type == "psw") {
        $salt = "vive le projet tweet_academy";
        return hash('ripemd160', $param . $salt);
    }
    
    if ($type == "int") {
        return filter_var($param, FILTER_SANITIZE_NUMBER_INT);
    }
}