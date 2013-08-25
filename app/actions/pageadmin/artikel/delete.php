<?php
$is_success= _query("delete from artikel where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Data artikel berhasil dihapus";
}else{
    $_SESSION['failed']="Data artikel gagal dihapus";
}
redirect('pageadmin/artikel/index');
?>
