<?php include('includes/header.php'); ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card mt-4 shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">Jaap</h4>
                        </div>
                        <div class="col-auto">
                            <a href="jaap-create.php" class="btn btn-primary">Add Jaap</a>
                        </div>
                        <div class="col-md-3">
                            <form class="d-flex" role="search">
                                <input id="searchInput" class="form-control me-2" type="search" placeholder="Search Jaap" aria-label="Search">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php alertMessage(); ?>
                    <?php
                    $jaap = getAll('tbljaap');
                    if (!$jaap) {
                        echo '<h4>Something Went Wrong</h4>';
                        return false;
                    }
                    if (mysqli_num_rows($jaap) > 0) {
                    ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="Table">
                                <thead>
                                    <tr>
                                        <th>Jaap ID</th>
                                        <th>Jaap Name</th>
                                        <th class="col-md-4">Jaap</th>
                                        <th>Start Date</th>
                                        <th>Close Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div id="noRecordMsg" class="text-center fw-bold" style="display: none; font-size: 24px">No record found</div>
                                    <?php foreach ($jaap as $jaapItems) :
                                        $status = ($jaapItems['status'] == 1 || (!empty($jaapItems['ClosedOn']) && $jaapItems['ClosedOn'] != '0000-00-00' && strtotime($jaapItems['ClosedOn']) < strtotime(date('y-m-d')))) ? 1 : 0;
                                    ?>
                                        <tr>
                                            <td><?= $jaapItems['id'] ?></td>
                                            <td><?= $jaapItems['JaapName'] ?></td>
                                            <td><?= $jaapItems['Jaap'] ?></td>
                                            <td><?= (!empty($jaapItems['StartOn']) && $jaapItems['StartOn'] != '0000-00-00') ? date('d-m-y', strtotime($jaapItems['StartOn'])) : ' ' ?></td>
                                            <td><?= (!empty($jaapItems['ClosedOn']) && $jaapItems['ClosedOn'] != '0000-00-00') ? date('d-m-y', strtotime($jaapItems['ClosedOn'])) : ' ' ?></td>
                                            <td>
                                                <?php
                                                $status;
                                                if ($status == 1) {
                                                    echo '<span class="badge bg-primary">Completed</span>';
                                                } else {
                                                    echo '<span class="badge bg-info">OnGoing</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="col-md-2">
                                                <a href="jaap-edit.php?id=<?= $jaapItems['id']; ?>" class="btn btn-success btn-sm">&nbsp; Edit &nbsp;</a>
                                                <a onclick="return confirm('Are you sure want to delete the Jaap ?')" href="jaap-delete.php?id=<?= $jaapItems['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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
    </div>
</div>
<!-- End of Content Wrapper -->

<?php include('includes/footer.php'); ?>
