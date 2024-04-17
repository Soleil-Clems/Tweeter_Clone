<?php
function myVerify(...$args) {
    foreach ($args as $arg) {

        if (isset($arg) && !empty($arg)) {
            return true;
        } else {
            return false;
        }
    }
}