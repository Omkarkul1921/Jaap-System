<?php
require 'config/function.php';

if(isset($_SESSION['LoggedIn'])){
    LogoutSession();
    redirect('login.php','Logged Out Successfully');
}
?>


