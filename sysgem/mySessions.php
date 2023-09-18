<?php
function setSession($key, $value){
    $_SESSION[$key] = $value;
}
function checkSession($key){
    return isset($_SESSION[$key]);
}
function getSession($key){
    return $_SESSION[$key];
}
?>