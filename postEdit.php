<?php
include_once "views/top.php";
include_once "views/jumbotron.php";
if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
    $r = getSinglePost($pid);
    $posts = [];
    foreach ($r as $item) {
        $posts["title"] = $item["title"];
        $posts["writer"] = $item["writer"];
        $posts["content"] = $item["content"];
        $posts["imglink"] = $item["imglink"];
    }
}
if(isset($_POST["submit"])){
    $file = $_FILES["file"];
    $imgname = "";
    if($_FILES["file"]["name"] != null){
        $imgname = mt_rand(time(), time()) . "_" . $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $imgname);
    }else{
        $imgname = $_POST["oldimg"];
    }
    $title = $_POST["postitle"];
    $postype = $_POST["postype"];
    $postwriter = $_POST["postwriter"];
    $postcontent = $_POST["postcontent"];
    $subject = $_POST["subject"];

    $imglink = $imgname;
    $pid  = $_GET["pid"];
    updatePost($title, $postype, $postwriter, $postcontent, $imglink, $pid, $subject);
}
?>
<div class="container my-3">
    <div class="row">
        <?php include_once "views/siderbar.php" ?>
        <!-- Posting section starts -->
        <section class="col-md-9">
            <form class="p-5 mb-5" method="post" action="postEdit.php?pid=<?php echo $_GET["pid"];?>" enctype="multipart/form-data">
                <h3 class="text-primary english">Edit your post</h3>
                <div class="form-group">
                    <label for="postTitle" class="form-label english">Post Title</label>
                    <input type="text" class="form-control english" id="postTitle" name="postitle" value="<?php echo $posts["title"] ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="postWriter" class="form-label english">Post Writer</label>
                    <input type="text" class="form-control english" id="postWriter" name="postwriter" value="<?php echo $posts["writer"] ?>">
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
                    <textarea class="form-control" id="postContent" name="postcontent" rows="10"><?php echo $posts["content"] ?></textarea>
                </div>
                <div class="form-group mt-3">
                    <input type="file" class="form-control" id="file" name="file" aria-describedby="inputGroupFileAddon04" aria-label="Upload" multiple>
                    <input type="hidden" name="oldimg" value="$post["imglink"]">
                </div>
                <div class="float-end my-3">
                    <button type="button" class="btn btn-light">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Confirm changes</button>
                </div>
                <img src="upload/<?php echo $posts["imglink"]?>" class="img-fluid" alt="ERROR">
            </form>
        </section>
    </div>
</div>
<!-- Posting section ends -->
<?php include_once "views/footer.php"; ?>

<?php include_once "views/bot.php" ?>