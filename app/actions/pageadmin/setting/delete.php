<?php
$is_success= _query("delete from setting where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Data setting berhasil dihapus";
}else{
    $_SESSION['failed']="Data setting gagal dihapus";
}
redirect('pageadmin/setting/index');
?>
