<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0">Members</h4>
                </div>
                <div class="col-auto">
                    <a href="members-create.php" class="btn btn-primary">Add Member</a>
                </div>
                <div class="col-md-3">
                    <form class="d-flex" role="search">
                        <input id="searchInput" class="form-control me-2" type="search" placeholder="Search Name" aria-label="Search">
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>
            <?php
            $member = getAllMembers('tblmembers');
            if (!$member) {
                echo '<h4>Something Went Wrong</h4>';
                return false;
            }
            if (mysqli_num_rows($member) > 0) {

            ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="Table">
                        <thread>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thread>
                        <tbody>
                        <div id="noRecordMsg" class="text-center fw-bold" style="display: none; font-size: 24px">No record found</div>
                            <?php foreach ($member as $memberItems) : ?>
                                <tr class="text-center">
                                    <td><?= $memberItems['id'] ?></td>
                                    <td><?= $memberItems['FullName'] ?></td>
                                    <td><?= $memberItems['MobileNo'] ?></td>
                                    <td><?= $memberItems['Address'] ?></td>
                                    <td>
                                        <?php
                                        if ($memberItems['status'] == 1) {
                                            echo '<div class="badge bg-danger">Inactive</div>';
                                        } else {
                                            echo '&nbsp;<div class="badge bg-primary">Active</div>&nbsp;';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="members-edit.php?id=<?= $memberItems['id']; ?>" class="btn btn-success btn-sm">&nbsp; Edit &nbsp;</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
            ?>
                <h4 class="mb-0">No Record Found</h4>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>



