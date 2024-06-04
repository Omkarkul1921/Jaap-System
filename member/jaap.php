<?php
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Jaap
                <a href="jaap.php" class="btn btn-primary float-end">Add Jaap</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <?php
            $jaap = "SELECT * FROM tbljaap ORDER BY status = 0 DESC, id DESC;";
            $jaapResult = mysqli_query($conn, $jaap);
            if (!$jaapResult) {
                echo '<h4>Something Went Wrong</h4>';
                return false;
            }
            if (mysqli_num_rows($jaapResult) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Jaap Name</th>
                                <th class="col-md-5">Jaap</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Subscribe</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jaapResult as $jaapItems) :
                                $status = ($jaapItems['status'] == 1 || (!empty($jaapItems['ClosedOn']) && $jaapItems['ClosedOn'] != '0000-00-00' && strtotime($jaapItems['ClosedOn']) < strtotime(date('Y-m-d')))) ? 1 : 0;
                                
                                // Check subscription status for the current Jaap
                                $isSubscribed = isset($_SESSION['LoggedInMember']) ? isSubscribed($jaapItems['id'], $_SESSION['LoggedInMember']['id']) : false;
                            ?>
                                <tr class="text-center">
                                    <td><?= $jaapItems['JaapName'] ?></td>
                                    <td><?= $jaapItems['Jaap'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($jaapItems['CreatedOn'])) ?></td>
                                    <td><?= (!empty($jaapItems['ClosedOn']) && $jaapItems['ClosedOn'] != '0000-00-00') ? date('d-m-Y', strtotime($jaapItems['ClosedOn'])) : ' ' ?></td>
                                    <td>
                                        <?php
                                        if ($status == 1) {
                                            echo '<span class="badge badge-primary">Completed</span>';
                                        } else {
                                            echo '<span class="badge badge-info">OnGoing</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($status == 0 && !$isSubscribed) : ?>
                                            <a href="subscribe-add.php?id=<?= $jaapItems['id'] ?>" class="btn btn-warning btn-sm">Enroll</a>
                                        <?php elseif ($isSubscribed) : ?>
                                            <span class="btn btn-danger btn-sm">Enrolled</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($status == 0 && $isSubscribed) {
                                            echo '<a href="jaap-enter.php?id=' . $jaapItems['id'] . '" class="btn btn-success btn-sm">Add</a>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
            ?>
                <h4 class="text-danger">No Record Found</h4>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<?php
function isSubscribed($jaapId, $memberId)
{
    global $conn; // Assuming $conn is your database connection variable

    // Prepare and execute the query to check if a record exists in tblsubscribed
    $query = "SELECT * FROM tblsubscribed WHERE JaapId = $jaapId AND MemberId = $memberId";
    $result = mysqli_query($conn, $query);

    // Check if any rows are returned
    if ($result && mysqli_num_rows($result) > 0) {
        return true; // User is subscribed
    } else {
        return false; // User is not subscribed
    }
}
?>
