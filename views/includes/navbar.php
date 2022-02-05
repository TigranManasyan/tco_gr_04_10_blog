<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarText">

            <?php if(isset($_SESSION['checked_user'])): ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if($_SESSION['checked_user']['role_id'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Users</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://blog.loc/views/posts/all_posts.php">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://blog.loc/views/posts/my_posts.php">My  Posts</a>
                    </li>
                </ul>
                <div class="user-info d-flex align-items-center">

                    <div class="user-avatar">
                        <img class="user-avatar-img" src="http://blog.loc/public/uploads/images/<?= $_SESSION['checked_user']['avatar'] ?>" alt="">
                    </div>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                    </a>
                    <ul style="right:0; left:unset" class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="nav-link" href="http://blog.loc/views/auth/reset.php">Reset Password</a>
                        <a class="nav-link" href="http://blog.loc/routes/web.php?action=logout&user_id=<?= $_SESSION['checked_user']['id'] ?>">Log Out</a>
                    </ul>
                </div>

                <?php else: ?>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" href="http://blog.loc/views/auth/register.php">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://blog.loc/views/auth/login.php">Sign In</a>
                    </li>
                </ul>
            <?php endif; ?>

        </div>
    </div>
</nav>