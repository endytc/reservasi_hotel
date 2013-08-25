<?php
$admin=  _select_unique_result("select * from admin where id='$_GET[id]'");

$is_success= _query("delete from admin where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Data operator berhasil dihapus";
}else{
    $_SESSION['failed']="Data operator gagal dihapus";
}
redirect('pageadmin/operator/index');
?>
