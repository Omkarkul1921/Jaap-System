<?php include('includes/header.php'); ?>


<div class="container-fluid px-4">
    <h1 class="mt-4">Admin Dashboard</h1>
    <?php alertMessage(); ?>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Users</li>
    </ol>
    <div class="row">

        <a href="members.php" class="col-xl-3 col-md-6 mb-4 text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Members</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $status = mysqli_query($conn, "SELECT * FROM tblmembers WHERE Request='1'");
                                if ($status) {
                                    if (mysqli_num_rows($status) > 0) {
                                        $totalCount = mysqli_num_rows($status);
                                        echo $totalCount;
                                    } else {
                                        echo '0';
                                    }
                                } else {
                                    echo 'Something Went Wrong!';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>


        <a href="members.php" class="col-xl-3 col-md-6 mb-4 text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Active Members</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $status = mysqli_query($conn, "SELECT * FROM tblmembers WHERE status='0' and Request='1'");
                                if ($status) {
                                    if (mysqli_num_rows($status) > 0) {
                                        $totalCount = mysqli_num_rows($status);
                                        echo $totalCount;
                                    } else {
                                        echo '0';
                                    }
                                } else {
                                    echo 'Something Went Wrong!';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>


        <a href="approve-members.php" class="col-xl-3 col-md-6 mb-4 text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Registration Requests</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $status = mysqli_query($conn, "SELECT * FROM tblmembers WHERE status='0' and Request='0'");
                                if ($status) {
                                    if (mysqli_num_rows($status) > 0) {
                                        $totalCount = mysqli_num_rows($status);
                                        echo $totalCount;
                                    } else {
                                        echo '0';
                                    }
                                } else {
                                    echo 'Something Went Wrong!';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <hr>

        <ol class="breadcrumb mb-4 px-2">
            <li class="breadcrumb-item active">Jaap</li>
        </ol>

        <a href="jaap.php" class="col-xl-3 col-md-6 mb-4 text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Ongoing Jaap</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $status = mysqli_query($conn, "SELECT * FROM tbljaap WHERE status='0'");
                                if ($status) {
                                    if (mysqli_num_rows($status) > 0) {
                                        $totalCount = mysqli_num_rows($status);
                                        echo $totalCount;
                                    } else {
                                        echo '0';
                                    }
                                } else {
                                    echo 'Something Went Wrong!';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hands-praying fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>



        <a href="jaap.php" class="col-xl-3 col-md-6 mb-4 text-decoration-none">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Jaap</div>
                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                <?= getCount('tbljaap'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-atom fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <hr>

        <ol class="breadcrumb mb-4 px-2 ">
            <li class="breadcrumb-item active">Ongoing Jaap Counts</li>
        </ol>
        <div class="container-fluid px-4">
            <div class="row">
                <?php
                // Fetch JaapName from tbljaap where status=0
                $jaapQuery = mysqli_query($conn, "SELECT id, JaapName FROM tbljaap WHERE status=0");

                if ($jaapQuery) {
                    while ($jaapRow = mysqli_fetch_assoc($jaapQuery)) {
                        $jaapId = $jaapRow['id'];
                        $jaapName = $jaapRow['JaapName'];

                        // Fetch total JaapCount from tbljaapdetails for the current JaapName
                        $jaapCountQuery = mysqli_query($conn, "SELECT SUM(JaapCount) AS TotalJaapCount FROM tbljaapdetails WHERE JaapId=$jaapId");
                        $jaapCountRow = mysqli_fetch_assoc($jaapCountQuery);
                        $totalJaapCount = isset($jaapCountRow['TotalJaapCount']) ? $jaapCountRow['TotalJaapCount'] : 0;

                        // Display a card for each JaapName
                ?>



                        <a href="jaap-edit.php?id=<?= $jaapId ?>" class="col-xl-3 col-md-6 mb-4 text-decoration-none">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <?= $jaapName ?></div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">
                                                <?= $totalJaapCount ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-person-praying fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                <?php
                    }
                } else {
                    echo "Failed to fetch JaapName";
                }
                ?>
            </div>

        </div>

    </div>


    <?php include('includes/footer.php'); ?>