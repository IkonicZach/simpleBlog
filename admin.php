<?php
include_once "views/top.php";
include_once "views/jumbotron.php";
include_once "sysgem/postGenerator.php";

if (checkSession("username")) {
    if (getSession("username") != "minnthuta") {
        header("Location:index.php");
    }
} else {
    header("Location:index.php");
}
if(isset($_POST['submit'])){
    $postitle = $_POST["postitle"];
    $postype = $_POST["postype"];
    $postwriter = $_POST["postwriter"];
    $postcontent = $_POST["postcontent"];
    $subject = $_POST["subject"];

    $imglink = mt_rand(time(), time()) . "_" .  $_FILES["file"]["name"] . mt_rand(time(), time());
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $imglink);
    
    $bol = post($postitle, $postype, $postwriter, $postcontent, $imglink, $subject);
    if($bol){
        echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
        <strong>Posted successfully!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }else{
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
<!-- Posting section starts -->
        <section class="col-md-9">
            <form enctype="multipart/form-data" class="p-5 mb-5" method="post" action="admin.php">
                <h3 class="text-primary english">Create a new post</h3>
                <div class="form-group">
                    <label for="postTitle" class="form-label english">Post Title</label>
                    <input type="text" class="form-control english" id="postTitle" name="postitle">
                </div>
                <div class="form-group mt-3">
                    <label for="postWriter" class="form-label english">Post Writer</label>
                    <input type="text" class="form-control english" id="postWriter" name="postwriter">
                </div>
                <div class="form-group mt-3 row">
                    <div class="w-50">
                        <label for="postType" class="form-label english">Post Type</label>
                        <select class="form-select" aria-label="Default select example" id="postType" name="postype">
                            <option selected>Default</option>
                            <option value="1">Free</option>
                            <option value="2">Paid</option>
                        </select>
                    </div>
                    <div class="w-50">
                        <label for="subject" class="form-label english">Subject</label>
                        <select class="form-select" aria-label="Default select example" id="subject" name="subject">
                            <?php
                            $subjects = getAllSubject();
                            foreach($subjects as $subject){
                                echo "<option value='" . $subject["id"] . "'>" . $subject["name"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="postContent" class="form-label english">Post Content</label>
                    <textarea class="form-control" id="postContent" name="postcontent" rows="10"></textarea>
                </div>
                <div class="form-group mt-3">
                    <input type="file" class="form-control" id="file" name="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload" multiple>
                </div>
                <div class="float-end my-3">
                    <button type="button" class="btn btn-light">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-danger">Upload</button>
                </div>
            </form>
        </section>
    </div>
</div>
<!-- Posting section ends -->
<?php include_once "views/footer.php"; ?>

<?php include_once "views/bot.php" ?>