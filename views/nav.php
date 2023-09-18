<?php
require_once "sysgem/mySessions.php";
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand text-white english" href="index.php">Navbar</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link text-white english" aria-current="page" href="index.php">Latests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white english" href="filterPosts.php?sid=1">Politics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white english" href="filterPosts.php?sid=2">Sports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white english" href="filterPosts.php?sid=3">Health</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white english" href="filterPosts.php?sid=4">IT</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white english" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        if (checkSession("username")) {
                            echo getSession("username");
                        }else{
                            echo "Member";
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        if (checkSession("username")) {
                            echo "<a class='dropdown-item text-english' href='logout.php'>Logout</a>";
                        } else {
                            echo "<a class='dropdown-item text-english' href='login.php'>Login</a>
                                <a class='dropdown-item text-english' href='register.php'>Register</a>";
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
    </div>
</nav>