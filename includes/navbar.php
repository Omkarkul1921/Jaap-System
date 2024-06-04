<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);

?>
<nav class="navbar navbar-expand-lg bg-white shadow">
    <div class="container">

        <a class="navbar-brand" href="index.php">Jaap System</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" <?= $page == 'index.php' ? 'active' : ''; ?> href="index.php">Home</a>
                </li>
                <?php if (isset($_SESSION['LoggedIn'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="">

                            <?php
                            if (isset($_SESSION['LoggedInUser']['userName']) && !empty($_SESSION['LoggedInUser']['userName'])) {
                                echo htmlspecialchars($_SESSION['LoggedInUser']['userName']);
                            } elseif (isset($_SESSION['LoggedInMember']['userName']) && !empty($_SESSION['LoggedInMember']['userName'])) {
                                echo htmlspecialchars($_SESSION['LoggedInMember']['userName']);
                            } else {
                                echo 'Guest';
                            }
                            ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" <?= $page == 'logout.php' ? 'active' : ''; ?> href="logout.php">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" <?= $page == 'login.php' ? 'active' : ''; ?> href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>