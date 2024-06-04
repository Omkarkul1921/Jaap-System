<?php include('includes/header.php');

if (isset($_SESSION['LoggedIn'])) {
?>
    <script>
        window.location.href = 'index.php'
    </script>
<?php
}
?>
<div class="container">

<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                            </div>
                            <form class="user mt-5" action="login-code.php" method="POST">
                            <?php alertMessage(); ?>
                                <div class="form-group">
                                    <input type="tel" class="form-control form-control-user"  name="userMobile" placeholder="Enter PhoneNo" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password"  placeholder="Enter Password">
                                </div>
                                <button type="submit" name="loginBtn" class="btn btn-primary btn-user btn-block">Sign In</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="registration.php">Create an Account !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>

<?php include('includes/footer.php'); ?>