<?php

include ('../config/function.php');



if (isset($_POST['saveAdmin'])) {
    $fullName = validate($_POST['fullName']);
    $userName = validate($_POST['userName']);
    $userMobile = validate($_POST['userMobile']);
    $password = validate($_POST['password']);
    $status = validate($_POST['status']) == true ? 1 : 0;

    if (!preg_match('/^[A-Za-z\s]+$/', $userName)) {
        redirect('admin-create.php', 'Name must contain only letters and spaces');
    }    

    // Validate phone number
    if (!preg_match('/^[0-9]{10}$/', $userMobile)) {
        redirect('admin-create.php', 'Please enter a valid 10-digit phone number');
    }

    // Password length validation
    if (strlen($password) < 6) {
        redirect('admin-create.php', 'Password must be at least 6 characters long');
    }

    if ($userName != '' && $userMobile != '' && $password != '') {

        $phoneCheck = mysqli_query($conn, "SELECT * FROM  tbluser WHERE userMobile='$userMobile'");
        $phoneCheckMember = mysqli_query($conn, "SELECT * FROM  tblmembers WHERE MobileNo='$userMobile'");

        if ($phoneCheck) {
            if (mysqli_num_rows($phoneCheck) > 0 || mysqli_num_rows($phoneCheckMember) > 0) {
                redirect('admin-create.php', 'Mobile No already used by another user');
            }
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'fullName' => $fullName,
            'userName' => $userName,
            'userMobile' => $userMobile,
            'password' => $bcrypt_password,
            'status' => $status
        ];
        $result = insert('tbluser', $data);
        if ($result) {
            redirect('admins.php', 'Admin Created Successfully');
        } else {
            redirect('admin-create.php', 'Something Went Wrong');
        }
    } else {
        redirect('admin-create.php', 'Please Fill Required Feilds');
    }
}


if (isset($_POST['updateAdmin'])) {

    $adminId = validate($_POST['id']);

    $adminData = getById('tbluser', $adminId);
    if ($adminData['status'] != 200) {
        redirect('admin-edit.php?id=' . $adminId, 'Please Fill Required Feilds');
    }

    $fullName = validate($_POST['fullName']);
    $userName = validate($_POST['userName']);
    $userMobile = validate($_POST['userMobile']);
    $password = validate($_POST['password']);
    $status = validate($_POST['status']) == true ? 1 : 0;

    $phoneCheckQuery = "SELECT * FROM tbluser WHERE userMobile='$userMobile' AND id!='$adminId'";
    $checkResult = mysqli_query($conn, $phoneCheckQuery);
    if ($checkResult) {
        if (mysqli_num_rows($checkResult) > 0) {
            redirect('admin-edit.php?id=' . $adminId, 'Phone no already used by another user');
        }
    }

    if ($password != '') {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $hashedPassword = $adminData['data']['password'];
    }

    if ($userName != '' && $userMobile != '') {
        $data = [
            'fullName' => $fullName,
            'userName' => $userName,
            'userMobile' => $userMobile,
            'password' => $hashedPassword,
            'status' => $status
        ];
        $result = update('tbluser', $adminId, $data);
        if ($result) {
            redirect('admins.php?id=' . $adminId, 'Admin Updated Successfully');
        } else {
            redirect('admin-edit.php?id=' . $adminId, 'Something Went Wrong');
        }
    } else {
        redirect('admin-create.php', 'Please Fill Required Feilds');
    }
}


if (isset($_POST['saveJaap'])) {

    $JaapName = validate($_POST['JaapName']);
    $ClosedOn = validate($_POST['ClosedOn']);
    $StartOn = validate($_POST['StartOn']);
    $Jaap = validate($_POST['Jaap']);

    $data = [
        'JaapName' => $JaapName,
        'ClosedOn' => $ClosedOn,
        'StartOn' => $StartOn,
        'Jaap' => $Jaap
    ];
    $result = insert('tbljaap', $data);
    if ($result) {
        redirect('jaap.php', 'Jaap Created Successfully');
    } else {
        redirect('jaap-create.php', 'Something Went Wrong');
    }
}


if (isset($_POST['updateJaap'])) {
    // Validate input data
    $id = validate($_POST['id']);
    $JaapName = validate($_POST['JaapName']);
    $ClosedOn = validate($_POST['ClosedOn']);
    $StartOn = validate($_POST['StartOn']);
    $Jaap = validate($_POST['Jaap']);
    $status = isset($_POST['status']) ? 1 : 0;

    // Check if the Close On date is in the past, and set status accordingly
    if ($status == 0 && $ClosedOn != '' && strtotime($ClosedOn) < strtotime(date('Y-m-d'))) {
        $status = 1;
    }

    // Prepare data for update
    $data = [
        'JaapName' => $JaapName,
        'ClosedOn' => $ClosedOn,
        'StartOn' => $StartOn,
        'Jaap' => $Jaap,
        'status' => $status
    ];

    // Perform the update operation
    $result = update('tbljaap', $id, $data);

    // Redirect based on the result of the update operation
    if ($result) {
        redirect('jaap.php?id=' . $id, 'Jaap Updated Successfully');
    } else {
        redirect('jaap-edit.php?id=' . $id, 'Something Went Wrong');
    }
}



if (isset($_POST['saveMember'])) {
    $FullName = validate($_POST['FullName']);
    $MobileNo = validate($_POST['MobileNo']);
    $Password = validate($_POST['Password']);
    $Address = validate($_POST['Address']);
    $status = isset($_POST['status']) ? 1 : 0;

    if (!preg_match('/^[A-Za-z\s]+$/', $FullName)) {
        redirect('members-create.php', 'Name must contain only letters and spaces');
    }
    
    // Validate international phone number
    if (!preg_match('/^[0-9]{10}$/', $MobileNo)) {
        redirect('members-create.php', 'Please enter a valid 10-digit phone number');
    }

    // Password length validation
    if (strlen($Password) < 6) {
        redirect('members-create.php', 'Password must be at least 6 characters long');
    }

    if ($FullName != '' && $MobileNo != '' && $Password != '') {

        $phoneCheck = mysqli_query($conn, "SELECT * FROM  tblmembers WHERE MobileNo='$MobileNo'");
        $phoneCheckUser = mysqli_query($conn, "SELECT * FROM tbluser WHERE userMobile='$MobileNo'");
        if (mysqli_num_rows($phoneCheck) > 0 || mysqli_num_rows($phoneCheckUser) > 0) {
            redirect('members-create.php', 'Phone No already used by another user');
        }

        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

        $data = [
            'FullName' => $FullName,
            'MobileNo' => $MobileNo,
            'Password' => $hashedPassword,
            'Address' => $Address,
            'status' => $status,
            'Request' => 1
        ];
        $result = insert('tblmembers', $data);
        if ($result) {
            redirect('members.php', 'Member Created Successfully');
        } else {
            redirect('members.php', 'Something Went Wrong');
        }
    } else {
        redirect('members.php', 'Please Fill Required Fields');
    }
}



if (isset($_POST['updateMember'])) {

    $memberId = validate($_POST['id']);

    $memberData = getById('tblmembers', $memberId);
    if ($memberData['status'] != 200) {
        redirect('members-edit.php?id=' . $memberId, 'Please Fill Required Feilds');
    }
    
    $FullName = validate($_POST['FullName']);
    $MobileNo = validate($_POST['MobileNo']);
    $Password = validate($_POST['Password']);
    $Address = validate($_POST['Address']);
    $status = validate($_POST['status']) == true ? 1 : 0;

    $phoneCheckQuery = "SELECT * FROM tblmembers WHERE MobileNo='$MobileNo' AND id!='$memberId'";
    $checkResult = mysqli_query($conn, $phoneCheckQuery);
    if ($checkResult) {
        if (mysqli_num_rows($checkResult) > 0) {
            redirect('members-edit.php?id=' . $memberId, 'Phone no already used by another user');
        }
    }

    if ($Password != '') {
        $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);
    } else {
        $hashedPassword = $memberData['data']['Password'];
    }

    if ($MobileNo != '') {
        $data = [

            'FullName' => $FullName,
            'MobileNo' => $MobileNo,
            'Password' => $hashedPassword,
            'Address' => $Address,
            'status' => $status
        ];
        $result = update('tblmembers', $memberId, $data);
        if ($result) {
            redirect('members.php?id='.$memberId, 'Member Updated Successfully');
        } else {
            redirect('members-edit.php?id='.$memberId, 'Something Went Wrong');
        }
    } else {
        redirect('members-edit.php', 'Please Fill Required Feilds last');
    }
}


if (isset($_POST['updateCountJaap'])) {
    $id = validate($_POST['id']);
    $JaapCount = validate($_POST['JaapCount']);
    $Month = validate($_POST['Month']);

    $data = [
        'Month' => $Month,
        'JaapCount' => $JaapCount
    ];

    $result = update('tbljaapdetails', $id, $data);

    if ($result) {
        redirect('jaapdetail.php?id=' . $id, 'Jaap Detail Updated Successfully');
    } else {
        redirect('jaapdetail-edit.php?id=' . $id, 'Something Went Wrong');
    }
}


//Password update

if (isset($_POST['changePasswordBtn'])) {
    $oldPassword = validate($_POST['oldPassword']);
    $newPassword = validate($_POST['newPassword']);
    $confirmPassword = validate($_POST['confirmPassword']);


    if ($oldPassword != '' && $newPassword != '' && $confirmPassword != '') {

        $loggedInUserId = $_SESSION['LoggedInUser']['id'];
        $query = "SELECT * FROM tbluser WHERE id='$loggedInUserId' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];
            if (password_verify($oldPassword, $hashedPassword)) {

                // Old password matches, update the password
                if ($newPassword === $confirmPassword) {

                    $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                    $updateQuery = "UPDATE tbluser SET password='$hashedNewPassword' WHERE id='$loggedInUserId'";
                    $updateResult = mysqli_query($conn, $updateQuery);
                    if ($updateResult) {

                        redirect('changepass.php', 'Password updated successfully');
                    } else {
                        redirect('changepass.php', 'Something went wrong while updating password');
                    }
                } else {
                    redirect('changepass.php', 'New password and confirm password do not match');
                }
            } else {
                redirect('changepass.php', 'Old password is incorrect');
            }
        } else {
            redirect('changepass.php', 'User not found');
        }
    } else {
        redirect('changepass.php', 'All fields are mandatory');
    }
}


//Regestration Request Accept/Reject

if (isset($_POST['acceptMember'])) {
    $id = validate($_POST['id']);

    $data = [
        'Request' => 1
    ];

    $result = update('tblmembers', $id, $data);

    if ($result) {
        redirect('approve-members.php', 'Request Accected');
    } else {
        redirect('approve-members.php', 'Something Went Wrong');
    }
}


if (isset($_POST['rejectMember'])) {
    $id = validate($_POST['id']);

    $result = delete('tblmembers', $id);

    if ($result) {
        redirect('approve-members.php', 'Request Rejected');
    } else {
        redirect('approve-members.php', 'Something Went Wrong');
    }
}


