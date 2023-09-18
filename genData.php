<?php
require_once "sysgem/postGenerator.php";
$data = file_get_contents("genData.json");
$posts = json_decode($data, true);
$types = [1, 2];
$i = 0;
$writers = ["jen", "choco", "sushi", "mochi"];
$imglinks = ["1695013756_Qatar_Airways_logo.png", "1695011266_ Bwin-Logo.png", "1694972373_ Dell.png", "1694769796_Weibo Artist_ @斤斤a (2).jpg"];
$subjects = [1, 2, 3, 4];
foreach ($posts as $post) {
    $i++;
    $title = $post["title"];
    $content = $post["content"];
    $type = $types[$i % 2];
    $writer = $writers[$i % 4];
    $imglink = $imglinks[$i % 4];
    $subject = $subjects[$i % 4];
    post($title, $type, $writer, $content, $imglink, $subject);
}
?>