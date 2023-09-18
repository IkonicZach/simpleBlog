<?php
include_once "views/top.php";
?>

<div class="container my-3">
    <div class="row">
        <?php include_once "views/siderbar.php" ?>
        <section class="col-md-9">
            <div class="row">
                <?php
                $result = "";
                if (checkSession("username")) {
                    $result = getFilteredPost($_GET["sid"], 2);
                } else {
                    $result = getFilteredPost($_GET["sid"], 1);
                }
                foreach ($result as $post) {
                    $pid = $post["id"];
                    echo '<div class="col-md-6 mb-3">
                            <div class="card p-3">
                                <div class="card-block">
                                    <h1>' . $post["title"] . '</h1>
                                    <p>' . substr($post["content"],0 ,150) . '</p>
                                    <a href="detail.php?pid=' . $pid . '" class="btn btn-info btn-sm text-white">Read more...</a>
                                </div>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </section>
    </div>
</div>

<?php include_once "views/footer.php"; ?>

<?php include_once "views/bot.php" ?>