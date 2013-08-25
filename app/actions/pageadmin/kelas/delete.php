<?php
$kelas=  _select_unique_result("select * from kelas where id='$_GET[id]'");

$is_success= _query("delete from kelas where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Data kelas kamar berhasil dihapus";
}else{
    $_SESSION['failed']="Data kelas kamar gagal dihapus";
}
redirect('pageadmin/kelas/index');
?>
