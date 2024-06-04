<?php 
include('includes/header.php'); 
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Admins
                <a href="admin-create.php" class="btn btn-primary float-end">Add Admin</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <?php
                    $admins = getAll('tbluser');
                    if(!$admins){
                        echo '<h4>Something Went Wrong</h4>';
                        return false;
                    }
                    if(mysqli_num_rows($admins)>0){
                    
                    ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thread>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Name</th>
                            <th>Mobile No.</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php foreach($admins as $adminItems) : ?>
                        <tr class="text-center">
                            <td><?= $adminItems['id']?></td>
                            <td><?= $adminItems['fullName']?></td>
                            <td><?= $adminItems['userName']?></td>
                            <td><?= $adminItems['userMobile']?></td>
                            <td>
                            <?php 
                                    if($adminItems['status'] == 1 ){
                                        echo '<span class="badge bg-danger">Banned</span>';
                                    }else{
                                        echo '<span class="badge bg-primary">Active</span>';
                                    }
                                    ?>
                            </td>
                            <td>
                                <a href="admin-edit.php?id=<?=$adminItems['id']; ?>" class="btn btn-success btn-sm">&nbsp; Edit &nbsp;</a>
                                <a onclick="return confirm('Really are you sure You want to delete the Admin !! ')" href="admin-delete.php?id=<?=$adminItems['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <?php
                        }else{
                            ?>
                <h4 class="mb-0">No Record Found</h4>

            <?php
                        }
                    ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>