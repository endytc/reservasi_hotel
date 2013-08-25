<?php
$kamar=  _select_unique_result("select * from kamar where id='$_GET[id]'");

$is_success= _query("delete from kamar where id=$_GET[id]");
if($is_success){
    $is_success= _query("delete from user where id=$kamar[id_user]");
}
if($is_success){
    $_SESSION['success']="Data kamar berhasil dihapus";
}else{
    $_SESSION['failed']="Data kamar gagal dihapus";
}
redirect('pageadmin/kamar/index');
?>
