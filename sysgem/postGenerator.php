<?php
require_once "sysgem/DB_hacker.php";

function post($title, $type,$writer, $content, $link, $subject){
    $created_at = getTimeNow();
    $db = connect();
    $q = "INSERT INTO post (title, type, subject, writer, content, imglink, created_at)
    VALUES
    ('$title', $type, $subject, '$writer', '$content', '$link', '$created_at')";

    $r = mysqli_query($db, $q);
    return $r;
}
function updatePost($title, $type,$writer, $content, $link, $id, $subject){
    $db = connect();
    $q = "UPDATE post SET title = '$title', type = $type, subject = $subject,  writer = '$writer', content = '$content', imglink ='$link' WHERE id = $id";

    $r = mysqli_query($db, $q);
    if($r){
        header("location:showAllPost.php");
    }
}
function getAllPost($type, $start){
    $q = "";
    $db = connect();
    if($type == 1){
        $q = "SELECT * FROM post WHERE type=$type LIMIT $start,10";
    }else{
        $q = "SELECT * FROM post LIMIT $start,10";
    }
    $r = mysqli_query($db, $q);
    return $r;
}
function getSinglePost($pid){
    $db = connect();
    $q = "SELECT * FROM post WHERE id=$pid";
    $result = mysqli_query($db, $q);
    return $result;
}
function getFilteredPost($subjectid, $type){
    $db = connect();
    $q = "SELECT * FROM post WHERE subject=$subjectid AND type=$type";
    $result = mysqli_query($db, $q);
    return $result;    
}
function getAllSubject(){
    $db = connect();
    $q = "SELECT * FROM subject";
    $result = mysqli_query($db, $q);
    return $result;  
}
function getPostCount(){
    $db = connect();
    $q = "SELECT * FROM post"; 
    $result = mysqli_query($db, $q);
    return mysqli_num_rows($result);
}
?>