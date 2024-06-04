<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Add Admin
                <a href="admins.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
        <?php alertMessage(); ?>
            <form action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Full Name </label>
                        <input type="text" name="fullName" class="form-control" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">User Name *</label>
                        <input type="text" name="userName" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone No *</label>
                        <input type="tel" name="userMobile" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Password *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Status</label>
                        <br>
                        <input type="checkbox" name="status" style="width:30px;height:30px">
                    </div>
                    <div class="col-md-9 mb-3 text-end">
                        <br>
                        <button type="submit" name="saveAdmin" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>