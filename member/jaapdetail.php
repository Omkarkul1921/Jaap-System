<?php
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
        <h4 class="mb-0">Jaap Details
                <a href="jaap.php" class="btn btn-primary float-end">Add Jaap</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <?php
            $jaapdetails = getUserJaapDeatails('tbljaapdetails');
            if (!$jaapdetails) {
                echo '<h4>Something Went Wrong</h4>';
                return false;
            }
            if (mysqli_num_rows($jaapdetails) > 0) {

            ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thread>
                            <tr class="text-center">
                                <th>Jaap Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Month</th>
                                <th>Jaap Count</th>
                                <th>Actions</th>
                            </tr>
                        </thread>
                        <tbody>
                            <?php foreach ($jaapdetails as $jaapdetailsItems) : ?>
                                <tr class="text-center">
                                    <td><?= $jaapdetailsItems['JaapName'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($jaapdetailsItems['StartOn'])) ?></td>
                                    <td><?= date('d-m-Y', strtotime($jaapdetailsItems['ClosedOn'])) ?></td>
                                    <td><?= date('F Y', strtotime($jaapdetailsItems['Month'])) ?></td>
                                    <td><?= $jaapdetailsItems['JaapCount'] ?></td>
                                    <td> <a href="jaapdetail-edit.php?id=<?= $jaapdetailsItems['id']; ?>" class="btn btn-success btn-sm">Edit</a></td>
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