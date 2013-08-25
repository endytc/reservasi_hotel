<?php
$userResult=_select_unique_result("select * from admin where username='$_POST[username]' and password='".  md5($_POST['password'])."'");

//show_array($_SESSION);
//show_array($userResult);
//$haha   ="asdjkhkasjdhksahdkjsahd";
if(count($userResult)>0){
    $_SESSION['id_user']    =$userResult['id'];
    $_SESSION['status_user']    =$userResult['type'];
    $user=  get_user_login();
    $_SESSION['success']    ='Selamat datang '.$userResult['username']; 
}else{
    $_SESSION['failed']    ='Login gagal, user tidak ditemukan'; 
}
if($userResult['type']=='admin')
    redirect('pageadmin/admin');
else
    redirect('pageoperator');
?>
