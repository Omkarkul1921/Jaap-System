<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Add Member
                <a href="members.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
        <?php alertMessage(); ?>
            <form action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="FullName" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone No *</label>
                        <input type="tel" name="MobileNo" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Address </label>
                        <input type="text" name="Address" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Password *</label>
                        <input type="password" name="Password" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Status</label>
                        <br>
                        <input type="checkbox" name="status" style="width:30px;height:30px">
                    </div>
                    <div class="col-md-9 mb-3 text-end">
                        <br>
                        <button type="submit" name="saveMember" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>