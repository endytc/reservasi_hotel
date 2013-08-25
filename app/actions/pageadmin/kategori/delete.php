<?php
$is_success= _query("delete from kategori where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Data kategori berhasil dihapus";
}else{
    $_SESSION['failed']="Data kategori gagal dihapus";
}
redirect('pageadmin/kategori/index');
?>
