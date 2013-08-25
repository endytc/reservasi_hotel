<?php
$bank=  _select_unique_result("select * from bank where id='$_GET[id]'");

$is_success= _query("delete from bank where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Data bank berhasil dihapus";
}else{
    $_SESSION['failed']="Data bank gagal dihapus";
}
redirect('pageadmin/bank/index');
?>
