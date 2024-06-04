<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Add Jaap
                <a href="jaap.php" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
        <!-- <?php alertMessage(); ?> -->
            <form action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Jaap Name *</label>
                        <input type="text" name="JaapName" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Start Date </label>
                        <input type="date" name="StartOn" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Close On </label>
                        <input type="date" name="ClosedOn" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Jaap *</label>
                        <input type="text" name="Jaap" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3 text-end">

                        <button type="submit" name="saveJaap" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>