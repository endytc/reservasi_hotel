<?php
$checkIn=  _select_unique_result("select * from checkin where id='$_GET[id]'");

$is_success= _query("delete from checkin where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Checkin berhasil dihapus";
}else{
    $_SESSION['failed']="Checkin gagal dihapus";
}
redirect('checkin/history_checkin');
?>
