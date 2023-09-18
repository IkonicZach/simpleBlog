<?php
include_once "views/top.php";
include_once "views/jumbotron.php";

if (checkSession("username")) {
    if (getSession("username") != "minnthuta") {
        header("Location:index.php");
    }
} else {
    header("Location:index.php");
}
if (isset($_POST['submit'])) {
    $postitle = $_POST["postitle"];
    $postype = $_POST["postype"];
    $postwriter = $_POST["postwriter"];
    $postcontent = $_POST["postcontent"];

    $imglink = mt_rand(time(), time()) . "_" .  $_FILES["file"]["name"] . mt_rand(time(), time());
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $imglink);

    $bol = post($postitle, $postype, $postwriter, $postcontent, $imglink, $subject);
    if ($bol) {
        echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
        <strong>Posted successfully!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <strong>Posting failed!</strong> Something went wrong.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
}
?>
<div class="container my-3">
    <div class="row">
        <?php include_once "views/siderbar.php" ?>
        <section class="col-md-9">
            <?php
            $result = getAllPost(2, 1);
            foreach ($result as $post) {
                echo '<div class="card p-3 mb-3">
                            <div class="card-block">
                                <h3>' . substr($post["title"], 0, 20) . '</h3>
                                <p>' . substr($post["content"], 0, 100) . "..." . '</p>
                                <a class="btn btn-primary float-end" href="postEdit.php?pid=' . $post["id"] . '">Edit</a>
                            </div>
                        </div>';
            }
            ?>
        </section>
    </div>
</div>
<?php include_once "views/footer.php"; ?>

<?php include_once "views/bot.php" ?>