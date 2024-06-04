<?php include('includes/header.php');?>

<div class="py-5 mainPosBg" >

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 py-5 text-center gradient">
            <h1 class="mt-3 my-4 text-black font-weight-bold">Jaap System</h1>
            
            <?php if(!isset($_SESSION['LoggedIn'])): ?>
                <a href="login.php" class="btn btn-primary my-5 btn-icon-split">
                    <span class="icon text-white">
                        <i class="fas fa-om"></i>
                    </span>
                    <span class="text">Login</span>
                </a>
            <?php else: ?>
                <a href="<?php
                    if (isset($_SESSION['LoggedInUser']['userName']) && !empty($_SESSION['LoggedInUser']['userName'])) {
                        echo 'admin/index.php';
                    } elseif (isset($_SESSION['LoggedInMember']['userName']) && !empty($_SESSION['LoggedInMember']['userName'])) {
                        echo 'member/index.php';
                    } else {
                        echo '#';
                    }
                ?>" class="btn btn-primary my-5 btn-icon-split">
                    <span class="icon text-white">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="text">Go to Dashboard</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

</div>


<?php include('includes/footer.php');?>