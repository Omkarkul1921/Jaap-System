<?php
require 'config/function.php';

if (isset($_POST['loginBtn'])) {
    $userMobile = validate($_POST['userMobile']);
    $password = validate($_POST['password']);

    if ($userMobile != '' && $password != '') { 

        
        // Check tbluser table
        $query = "SELECT * FROM tbluser WHERE userMobile='$userMobile' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];
            // Logging to console
            if (password_verify($password, $hashedPassword)) {
                if ($row['status'] == 1) {
                    redirect('login.php', 'Banned Admin.. Contact Admin');
                }

                $_SESSION['LoggedIn'] = true;
                $_SESSION['LoggedInUser'] = [
                    'id' => $row['id'],
                    'userName' => $row['userName'],
                    'userMobile' => $row['userMobile']
                ];

                redirect('admin/index.php', 'Logged In Successfully as Admin -' . $_SESSION["LoggedInUser"]["userName"]);
            } else {
                redirect('login.php', 'Invalid Password');
            }
        }

        // Check tblmembers table
        $query = "SELECT * FROM tblmembers WHERE MobileNo='$userMobile' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['Password'];
            if (password_verify($password, $hashedPassword)) { 
                if ($row['status'] == 1) {
                    redirect('login.php', 'Account Inactived..  For Activation Contact Admin');
                }
                if ($row['Request'] == 0) {
                    redirect('login.php', 'Be Patient.. Wait for Approval or Contact Admin');
                }

                $_SESSION['LoggedIn'] = true;
                $_SESSION['LoggedInMember'] = [
                    'id' => $row['id'],
                    'userName' => $row['FullName'],
                    'MobileNo' => $row['MobileNo']
                ];

                redirect('member/index.php', 'Logged In Successfully as Member - ' . $_SESSION["LoggedInMember"]["userName"]);
            } else {
                redirect('login.php', 'Invalid Password');
            }
        }

        
        redirect('login.php', 'Invalid Mobile No');
    } else {
        redirect('login.php', 'All fields are mandatory');
    }
}


if (isset($_POST['registerMember'])) {
    $FullName = validate($_POST['FullName']);
    $MobileNo = validate($_POST['MobileNo']);
    $Password = validate($_POST['Password']);
    $Address = validate($_POST['Address']);

    if ($FullName != '' && $MobileNo != '' && $Password != '') {

        $phoneCheck = mysqli_query($conn, "SELECT * FROM  tblmembers WHERE MobileNo='$MobileNo'");
        $phoneCheckUser = mysqli_query($conn, "SELECT * FROM tbluser WHERE userMobile='$MobileNo'");
        if (mysqli_num_rows($phoneCheck) > 0 || mysqli_num_rows($phoneCheckUser) > 0) {
            redirect('registration.php', 'Phone Number already used by another user');
        }

        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

        $data = [
            'FullName' => $FullName,
            'MobileNo' => $MobileNo,
            'Password' => $hashedPassword,
            'Address' => $Address,
            'Request' => 0
        ];
        $result = insert('tblmembers', $data);
        if ($result) {
            redirect('login.php', 'Member Request Sent..Please Wait until Accepted');
        } else {
            redirect('registration.php', 'Something Went Wrong');
        }
    } else {
        redirect('registration.php', 'Please Fill Required Fields');
    }
}

?>
