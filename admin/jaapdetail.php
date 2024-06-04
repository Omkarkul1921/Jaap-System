<?php
include('includes/header.php');
?>

<div class="container-fluid px-4 mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="font-weight-bold text-primary mb-0 h5">Jaap Details</h6>
            <form class="d-flex" role="search">
                <input id="searchInput" class="form-control me-2" type="search" placeholder="Search">
            </form>
        </div>

        <div class="card-body">
            <?php alertMessage(); ?>
            <?php
            $jaapdetails = getAllJaapDeatails('tbljaapdetails');
            if (!$jaapdetails) {
                echo '<h4>Something Went Wrong</h4>';
                return false;
            }
            if (mysqli_num_rows($jaapdetails) > 0) {

            ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="Table" width="100%" cellspacing="0">
                        <thread>
                            <tr class="text-center">
                                <th>Member Name</th>
                                <th>Jaap Name</th>
                                <th>Started On</th>
                                <th>Month</th>
                                <th>Jaap Count</th>
                                <th>Actions</th>
                            </tr>
                        </thread>
                        <tbody>
                            <div id="noRecordMsg" class="text-center fw-bold" style="display: none; font-size: 24px">No record found</div>
                            <?php foreach ($jaapdetails as $jaapdetailsItems) : ?>
                                <tr>
                                    <td class="text-center"><?= $jaapdetailsItems['FullName'] ?></td>
                                    <td class="text-center"><?= $jaapdetailsItems['JaapName'] ?></td>
                                    <td class="text-center"><?= date('d-m-Y', strtotime($jaapdetailsItems['StartOn'])) ?></td>
                                    <td class="text-center"><?= date('F Y', strtotime($jaapdetailsItems['Month'])) ?></td>
                                    <td class="text-center"><?= $jaapdetailsItems['JaapCount'] ?></td>
                                    <td class="text-center">
                                        <a href="jaapdetail-edit.php?id=<?= $jaapdetailsItems['id']; ?>" class="btn btn-success btn-sm">Edit</a>
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