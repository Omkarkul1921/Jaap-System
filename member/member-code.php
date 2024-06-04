<?php
include('../config/function.php');
require('../razorpay-php/Razorpay.php');

use Razorpay\Api\Api;

if (isset($_POST['saveCountJaap'])) {
    $JaapId = validate($_POST['JaapId']);
    $MemberId = validate($_POST['MemberId']);
    $StartOn = validate($_POST['StartOn']);
    $Month = validate($_POST['Month']);
    $JaapCount = validate($_POST['JaapCount']);

    $query = "SELECT * FROM tbljaapdetails WHERE JaapID = '$JaapId' AND MemberId = '$MemberId' AND Month = '$Month'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        redirect('jaapdetail.php', 'Jaap Count Already Entered');
    } else {
        $data = [
            'JaapId' => $JaapId,
            'MemberId' => $MemberId,
            'CreatedOn' => $StartOn,
            'Month' => $Month,
            'JaapCount' => $JaapCount
        ];
        $result = insert('tbljaapdetails', $data);
        if ($result) {
            redirect('jaap.php', 'Jaap Count Saved Successfully');
        } else {
            redirect('jaap-create.php', 'Something Went Wrong');
        }
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
        redirect('jaapdetail.php?id=' . $id, 'Jaap Updated Successfully');
    } else {
        redirect('jaapdetail-edit.php?id=' . $id, 'Something Went Wrong');
    }
}

if (isset($_POST['Subscribe'])) {
    $JaapId = validate($_POST['JaapId']);
    $MemberId = $_SESSION['LoggedInMember']['id'];
    $Status = 1;

    $data = [
        'JaapId' => $JaapId,
        'MemberId' => $MemberId,
        'Status' => $Status
    ];

    $result = insert('tblsubscribed', $data);

    if ($result) {
        redirect('jaap.php', 'Subscribed Successfully');
    } else {
        redirect('jaap-create.php', 'Something Went Wrong');
    }
}

if (isset($_POST['changeMemberPasswordBtn'])) {
    $oldPassword = validate($_POST['oldPassword']);
    $newPassword = validate($_POST['newPassword']);
    $confirmPassword = validate($_POST['confirmPassword']);

    if ($oldPassword != '' && $newPassword != '' && $confirmPassword != '') {
        $loggedInMemberId = $_SESSION['LoggedInMember']['id'];
        $query = "SELECT * FROM tblmembers WHERE id='$loggedInMemberId' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['Password'];
            if (password_verify($oldPassword, $hashedPassword)) {
                if ($newPassword === $confirmPassword) {
                    $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                    $updateQuery = "UPDATE tblmembers SET password='$hashedNewPassword' WHERE id='$loggedInMemberId'";
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
            redirect('changepass.php', 'Member not found');
        }
    } else {
        redirect('changepass.php', 'All fields are mandatory');
    }
}

$keyId = 'rzp_test_ySXEeUvsAdZYvS';
$keySecret = 'ouQ1Tyd0OJv66xjLQA6Zqh5D';
$api = new Api($keyId, $keySecret);

if (!empty($_POST['razorpay_payment_id'])) {
    $payment_id = $_POST['razorpay_payment_id'];
    $order_id = $_SESSION['razorpay_order_id'];

    try {
        $payment = $api->payment->fetch($payment_id);

        if ($payment->status == 'captured') {
            echo "Payment successful!";
            redirect('donation.php','Thanks for Donation');
            // Add your success logic here (e.g., save to database, send email, etc.)
        } else {
            echo "Payment failed!";
            // Add your failure logic here
        }
    } catch (\Exception $e) {
        // Handle exceptions
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Payment not made.";
}
?>
