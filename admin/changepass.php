<?php
include('includes/header.php');
?>


<div class="py-5 bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-4">
                    <?php alertMessage(); ?>
                    <div class="p-5">
                        <h4 class="text-dark mb-3 text-center">Change Password of <?= $_SESSION['LoggedInUser']['userName'] ?></h4>
                        <form action="code.php" method="POST">
                            <div class="mb-3">
                                <label>Old Password</label>
                                <input type="password" name="oldPassword" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="newPassword" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Confirm New Password</label>
                                <input type="password" name="confirmPassword" class="form-control" required>
                            </div>
                            <div class="my-3">
                                <button type="submit" name="changePasswordBtn" class="btn btn-primary w-100 mt-2">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
