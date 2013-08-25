<?php
$userResult=_select_unique_result("select * from member 
join pengunjung on pengunjung.id=member.id_pengunjung    
where username='$_POST[username]' and password='".  md5($_POST['password'])."'");

if(isset($userResult['id_pengunjung'])){
    $_SESSION['id_user']    =$userResult['id_pengunjung'];
    $_SESSION['status_user']    ='member';
    $_SESSION['success']    ='Selamat datang '.$userResult['nama']; 
}else{
    $_SESSION['failed']    ='Login gagal, user tidak ditemukan'; 
    redirect('user/login');
}
redirect('index');
?>
