<?php
$kategori_fasilitas=  _select_unique_result("select * from kategori_fasilitas where id='$_GET[id]'");

$is_success= _query("delete from kategori_fasilitas where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Data kategori_fasilitas berhasil dihapus";
}else{
    $_SESSION['failed']="Data kategori_fasilitas gagal dihapus";
}
redirect('pageadmin/kategori_fasilitas/index');
?>
