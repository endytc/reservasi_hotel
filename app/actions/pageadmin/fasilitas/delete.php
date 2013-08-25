<?php
$fasilitas=  _select_unique_result("select * from fasilitas where id='$_GET[id]'");

$is_success= _query("delete from fasilitas where id=$_GET[id]");
if($is_success){
    $is_success= _query("delete from user where id=$fasilitas[id_user]");
}
if($is_success){
    $_SESSION['success']="Data fasilitas berhasil dihapus";
}else{
    $_SESSION['failed']="Data fasilitas gagal dihapus";
}
redirect('pageadmin/fasilitas/index');
?>
