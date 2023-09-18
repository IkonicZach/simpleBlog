<?php
include_once "views/top.php";
include_once "views/jumbotron.php";
if(isset($_GET['pid'])){
    $pid = $_GET["pid"];
}
?>

<div class="container my-3">
    <div class="card col-md-8 offset-md-2 px-5 py-3">        <?php
        $result = getSinglePost($pid);
        foreach($result as $data){
            echo '<div class="card-header"><h2 class="english d-inline-block">'. $data["title"] .'</h2><span class="float-end">' . $data["created_at"] . '</div>';
            echo '<img src="upload/' . $data["imglink"] . '" alt="error" class="img-fluid py-3">';
            echo '<div class="card-block"><p class="english">' . $data["content"] . '</p></div>';
            echo '<div class="card-footer d-flex justify-content-between">
                    <p class="english">' . $data["writer"] . '</p> 
                    <a class="btn btn-primary" href="postEdit.php?pid=' . $data["id"] . '">Edit</a>
                  </div>';            
        }
        ?>
    </div>
</div>

<?php include_once "views/footer.php"; ?>

<?php include_once "views/bot.php" ?>