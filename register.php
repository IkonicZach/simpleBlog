<?php
include_once "views/top.php";

if (isset($_POST['submit'])) {
    $name = $_POST["username"];
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $r = register($name, $email, $pass);
    $message = "";
    switch ($r) {
        case "Registration successful.":
            $message = "Registration successful.";
            setSession("username", $name);
            setSession("email", $email);
            if ($name === "minnthuta" && $email === "minnthuta606@gmail.com") {
                header("location:admin.php");
                echo "True";
            } else {
                header("location:index.php");
                echo "False";
            }
            break;
        case "Email already in used.":
            $message = "Email is already in use.";
            break;
        case "Registration failed.":
            $message = "Registration failed.";
            break;
        case "Failed":
            $message = "Failed";
            break;
    }
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>" . $message . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}
?>
<!-- Login section starts -->
<div class="container my-5">
    <div class="col-md-8 offset-md-2">
        <form class="border borderColor rounded  w-75 mx-auto p-5" action="register.php" method="post">
            <h3 class="english mb-5">Register to <span class="text-primary">NavBar</span> community.</h3>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" value="username" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">First and last name</span>
                <input type="text" aria-label="First name" placeholder="(1-10 characters)" name="fName" class="form-control">
                <input type="text" aria-label="Last name" placeholder="(1-10 characters)" name="lName" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter your password (6-20 characters)">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-info btn-primary">Register</button>
        </form>
    </div>
</div>
<!-- Login section ends -->
<?php include_once "views/footer.php"; ?>

<?php include_once "views/bot.php" ?>