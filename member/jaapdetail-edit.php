<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Edit Jaap Detail
                <a href="jaapdetail.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <form action="member-code.php" method="POST">

                <?php
                if (isset($_GET['id'])) {
                    if ($_GET['id'] != '') {
                        $jaapDetailId = $_GET['id'];

                        // Fetch data from tbljaapdetails based on ID
                        $jaapDetailData = getById('tbljaapdetails', $jaapDetailId);

                        if ($jaapDetailData && $jaapDetailData['status'] == 200) {
                            $jaapId = $jaapDetailData['data']['JaapId'];

                            // Fetch corresponding jaap data from tbljaap based on JaapId
                            $jaapData = getById('tbljaap', $jaapId);

                            if ($jaapData && $jaapData['status'] == 200) {
                ?>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th class="text-center">Jaap Name</th>
                                                <td><?= $jaapData['data']['JaapName']; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Jaap</th>
                                                <td><?= $jaapData['data']['Jaap']; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Started On</th>
                                                <td><?= date('d-m-Y', strtotime($jaapData['data']['StartOn'])); ?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Closed On</th>
                                                <td><?= date('d-m-Y', strtotime($jaapData['data']['ClosedOn'])); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <!-- Additional form fields Include hidden input fields for necessary data -->

                                    <input type="hidden" name="id" value="<?= $jaapDetailData['data']['id']; ?>">
                                    <input type="hidden" name="JaapId" value="<?= $jaapDetailData['data']['JaapId']; ?>">
                                    <input type="hidden" name="MemberId" value="<?= $jaapDetailData['data']['MemberId']; ?>">

                                    <div class="container">
                                        <div class="row justify-content-center text-center">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label fw-bold">Month and Year:</label>
                                                <input type="month" class="form-control" name="Month" value="<?= $jaapDetailData['data']['Month']; ?>" min="<?= date('Y-m', strtotime($jaapData['data']['StartOn'])); ?>" max="<?= min(date('Y-m', strtotime($jaapData['data']['ClosedOn'])), date('Y-m')); ?>" required>
                                            </div>

                                            

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label fw-bold">Jaap Count:</label>
                                                <input type="number" class="form-control" name="JaapCount" value="<?= $jaapDetailData['data']['JaapCount']; ?>" required>
                                            </div>

                                            <button type="submit" name="updateCountJaap" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                <?php
                            } else {
                                echo '<h5>' . $jaapData['message'] . '</h5>';
                            }
                        } else {
                            echo '<h5>' . $jaapDetailData['message'] . '</h5>';
                        }
                    } else {
                        echo '<h5>No ID Found</h5>';
                    }
                } else {
                    echo '<h5>No ID Given in Params</h5>';
                }
                ?>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
