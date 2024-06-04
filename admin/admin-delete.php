<?php

require '../config/function.php';

$paramResultId = checkParamId('id');
if(is_numeric($paramResultId)){

    $adminId = validate($paramResultId);

    $admin = getById('tbluser', $adminId);
    if($admin['status']==200){
        $adminDeleteRes = delete('tbluser',$adminId);
        if($adminDeleteRes){
            redirect('admins.php','Admin deleted Successfully.');
        }else{
            redirect('admins.php','Something Went Wrong.');
        }
    }else{
        redirect('admins.php',$admin['message']);
    }
    // echo $adminId;    
}else{
    redirect('admins.php','Something Went Wrong.');
}
?>