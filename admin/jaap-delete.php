<?php

require '../config/function.php';

$paramResultId = checkParamId('id');
if(is_numeric($paramResultId)){

    $jaapId = validate($paramResultId);

    $jaap = getById('tbljaap', $jaapId);
    if($jaap['status']==200){
        $jaapDeleteRes = delete('tbljaap',$jaapId);
        if($jaapDeleteRes){
            redirect('jaap.php','Jaap deleted Successfully.');
        }else{
            redirect('jaap.php','Something Went Wrong.');
        }
    }else{
        redirect('jaap.php',$jaap['message']);
    }
    // echo $jaapId;    
}else{
    redirect('jaap.php','Something Went Wrong.');
}
?>