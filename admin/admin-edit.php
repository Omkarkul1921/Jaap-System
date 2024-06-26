<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Edit Admin
                <a href="admins.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">


                <?php
                if(isset($_GET['id'])) {
                    if ($_GET['id'] != '') {
                        $adminId = $_GET['id'];
                    } else {
                        echo '<h5>No ID Found</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>No ID Given in Params</h5>';
                    return false;
                }
                $adminData = getById('tbluser', $adminId);
                if ($adminData) {
                    if ($adminData['status'] == 200) {
                ?>

                        <input type="hidden" name="id" value="<?= $adminData['data']['id']; ?>">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name *</label>
                                <input type="text" name="fullName" value="<?= $adminData['data']['fullName']; ?>" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Name *</label>
                                <input type="text" name="userName" value="<?= $adminData['data']['userName']; ?>" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Mobile No.*</label>
                                <input type="tel" name="userMobile" value="<?= $adminData['data']['userMobile']; ?>" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Password *</label>
                                <input type="password" name="password" value="<?= $adminData['data']['password']; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">Status</label>
                                <br>
                                <input type="checkbox" name="status" <?= $adminData['data']['status'] == 1 ? 'checked' : ''; ?> style="width:30px;height:30px">

                            </div>
                            <div class="col-md-9 mb-3 text-end">
                                <button type="submit" name="updateAdmin" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                <?php
                    } else {
                        echo '<h5>' . $adminData['message'] . '</h5>';
                    }
                } else {
                    echo 'Something Went Wrong';
                    return false;
                }

                ?>



            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>