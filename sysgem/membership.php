<?php
require_once ("DB_hacker.php");

function register($name, $email, $pass){
    if(nameCheck($name) && emailCheck($email) && passCheck($pass)){
        return insertUniqueData($name, $email, $pass);
    }else{
        return "Failed";
    }
}
function loginUser($email, $pass){
    if(emailCheck($email) && passCheck($pass)){
        return userLogin($email, $pass);
    }else{
        return "Authentication failed.";
    }
}
function nameCheck($name){
    if(strlen($name) >= 6){
        $bol = preg_match('/^[\w]+$/', $name);
        return $bol;
    }else{
        return false;
    }
}
function emailCheck($email){
    if(strlen($email) >= 15){
        $bol = preg_match('/^[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,4}+$/', $email);
        return $bol;
    }else{
        return false;
    }
}
function passCheck($pass){
    if(strlen($pass) >=  6){
        $bol = preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[_|[^\w])(?=.*\d)/', $pass);
        return $bol;
    }else{
        return false;
    }
}
?>