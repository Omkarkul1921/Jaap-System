<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Edit Jaap
                <a href="jaap.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <form action="code.php" method="POST">


                <?php
                if (isset($_GET['id'])) {
                    if ($_GET['id'] != '') {
                        $jaapId = $_GET['id'];
                    } else {
                        echo '<h5>No ID Found</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>No ID Given in Params</h5>';
                    return false;
                }
                $jaapData = getById('tbljaap', $jaapId);
                if ($jaapData) {
                    if ($jaapData['status'] == 200) {
                ?>

                        <input type="hidden" name="id" value="<?= $jaapData['data']['id']; ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Name *</label>
                                <input type="text" name="JaapName" value="<?= $jaapData['data']['JaapName']; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">Start On</label>
                                <input type="date" name="StartOn" value="<?= $jaapData['data']['StartOn']; ?>" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">End On</label>
                                <input type="date" name="ClosedOn" value="<?= $jaapData['data']['ClosedOn']; ?>" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Name *</label>
                                <input type="text" name="Jaap" value="<?= $jaapData['data']['Jaap']; ?>" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">Status</label>
                                <br>
                                <?php
                                $status = isset($jaapData['data']['status']) ? $jaapData['data']['status'] : 0;
                                ?>
                                <input type="checkbox" name="status" <?= $status == 1 ? 'checked' : ''; ?> style="width:30px;height:30px">

                            </div>
                            <div class="col-md-9 mb-12 text-end">
                                <br>
                                <button type="submit" name="updateJaap" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                <?php
                    } else {
                        echo '<h5>' . $jaapData['message'] . '</h5>';
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