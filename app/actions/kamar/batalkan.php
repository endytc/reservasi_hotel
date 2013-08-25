<?php
$checkIn=  _select_unique_result("select * from detail_checkin where id='$_GET[id]'");

$is_success= _query("delete from detail_checkin where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Checkin pada $checkIn[masuk] berhasil dihapus";
}else{
    $_SESSION['failed']="Checkin pada $checkIn[masuk] gagal dihapus";
}
redirect('checkin/detail_checkin');
?>
