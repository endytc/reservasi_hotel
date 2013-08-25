<?php
$is_success= _query("delete from kategori_artikel where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Data kategori artikel berhasil dihapus";
}else{
    $_SESSION['failed']="Data kategori artikel gagal dihapus";
}
redirect('pageadmin/kategori_artikel/index');
?>
