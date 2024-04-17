<?php

function my_password_verify($param1, $param2){
    if ($param1===$param2) {
        return true;
    }else{
        return false;
    }
}