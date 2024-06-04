<?php
include('includes/header.php');

if (isset($_GET['id'])) {
    $jaapId = $_GET['id'];
    $sql = "SELECT * FROM tbljaap WHERE id = $jaapId";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $jaapDetails = mysqli_fetch_assoc($result);
?>

        <div class="container-fluid px-4">
            <div class="card mt-4 shadow">
                <div class="card-header">
                    <h4 class="mb-0">Jaap Details
                    <a href="jaap.php" class="btn btn-danger float-end">Back</a></h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <th class="text-center">Jaap Name</th>
                            <td><?= $jaapDetails['JaapName'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-center">Jaap</th>
                                <td class="col-md-9"><?= $jaapDetails['Jaap'] ?></td>
                            </tr>
                            <tr>
                                <th class="text-center">Started On</th>
                                <td><?= date('d-m-Y', strtotime($jaapDetails['StartOn'])) ?></td>
                            </tr>
                            <tr>
                                <th class="text-center">Closes On</th>
                                <td><?= date('d-m-Y', strtotime($jaapDetails['ClosedOn'])) ?></td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="container">
                        <div class="row justify-content-center text-center">
                            <form action="member-code.php" method="POST" class="col-md-6">
                                <input type="hidden" name="JaapId" value="<?= $jaapDetails['id'] ?>">
                                <input type="hidden" name="MemberId" value="<?= $_SESSION["LoggedInMember"]["id"] ?>">
                                <input type="hidden" name="StartOn" value="<?= $jaapDetails['StartOn'] ?>">

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Month and Year:</label>
                                    <input type="month" class="form-control" name="Month" value="<?= date('Y-m') ?>" max="<?= date('Y-m') ?>" min="<?= date('Y-m', strtotime($jaapDetails['StartOn'])) ?>" required>                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Jaap Count:</label>
                                    <input type="number" class="form-control" id="JaapCount" name="JaapCount" placeholder="Enter number of times jaap chanted" required>
                                </div>
                                <button type="submit" name="saveCountJaap" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    } else {
        echo '<h4>No Jaap found with the provided ID</h4>';
    }
} else {
    echo '<h4>Jaap ID is not provided in the URL</h4>';
}

include('includes/footer.php');
?>