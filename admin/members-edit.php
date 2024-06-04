<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Edit Member
                <a href="members.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">


                <?php
                if(isset($_GET['id'])) {
                    if ($_GET['id'] != '') {
                        $memberId = $_GET['id'];
                    } else {
                        echo '<h5>No ID Found</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>No ID Given in Params</h5>';
                    return false;
                }
                $memberData = getById('tblmembers', $memberId);
                if ($memberData) {
                    if ($memberData['status'] == 200) {
                ?>

                        <input type="hidden" name="id" value="<?= $memberData['data']['id']; ?>">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name *</label>
                                <input type="text" name="FullName" value="<?= $memberData['data']['FullName']; ?>" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Mobile No.</label>
                                <input type="tel" name="MobileNo" value="<?= $memberData['data']['MobileNo']; ?>" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Address </label>
                                <input type="text" name="Address" value="<?= $memberData['data']['Address']; ?>" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Password </label>
                                <input type="password" name="Password" value="" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">Inactive</label>
                                <br>
                                <input type="checkbox" name="status" <?= $memberData['data']['status'] == 1 ? 'checked' : ''; ?> style="width:30px;height:30px">

                            </div>
                            <div class="col-md-9 mb-3 text-end">
                                <button type="submit" name="updateMember" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                <?php
                    } else {
                        echo '<h5>' . $memberData['message'] . '</h5>';
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