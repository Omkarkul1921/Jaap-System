<?php
include('includes/header.php');

$query = "SELECT * FROM tblmembers WHERE Request = 0 AND status = 0";
$result = mysqli_query($conn, $query);
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="mb-0">Member Registration Requests</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="Table">
                    <?php if (mysqli_num_rows($result) > 0) : ?>
                        <thead> <!-- Corrected opening tag -->
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead> <!-- Corrected closing tag -->
                    <?php endif; ?>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0) : ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr class="text-center">
                                    <td><?= $row['FullName'] ?></td>
                                    <td><?= $row['MobileNo'] ?></td>
                                    <td><?= $row['Address'] ?></td>
                                    <td>
                                        <form action='code.php' method='POST'>
                                            <input type='hidden' name='id' value="<?= $row['id'] ?>">
                                            <button type='submit' class='btn btn-success' name='acceptMember' onclick="return confirm('Sure want to Accept Member?')">Accept</button>
                                            <button type='submit' class='btn btn-danger' name='rejectMember' onclick="return confirm('Sure want to Reject Member?')">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">
                                    <div id="noRecordMsg" class="text-center fw-bold" style="font-size: 24px">No Requests Found</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
