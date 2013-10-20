<?php
$is_success= _query("delete from setting where kd='$_GET[kd]'");
if($is_success){
    $_SESSION['success']="Data setting berhasil dihapus";
}else{
    $_SESSION['failed']="Data setting gagal dihapus";
}
redirect('pageadmin/setting/index');
?>
