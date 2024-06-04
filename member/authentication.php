<?php

if(isset($_SESSION['LoggedIn']))
{
    $MobileNo = validate($_SESSION['LoggedInMember']['MobileNo']);

    $query = "SELECT * FROM tblmembers WHERE MobileNo='$MobileNo' LIMIT 1";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) == 0){

        LogoutSession();
        redirect('login.php','Access Denied');
    }else{
        $row = mysqli_fetch_assoc($result);
        if($row['status'] == 1){
            LogoutSession();
            redirect('login.php','You account has been banned!! Please Contact Admin');
        }
}
}
else{
    redirect('login.php','Login to Continue');
}

?>