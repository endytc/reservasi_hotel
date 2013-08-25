<?php
$pengunjung=  _select_unique_result("select * from pengunjung where id='$_GET[id]'");

$is_success= _query("delete from pengunjung where id=$_GET[id]");
if($is_success){
    $_SESSION['success']="Data pengunjung berhasil dihapus";
}else{
    $_SESSION['failed']="Data pengunjung gagal dihapus";
}
redirect('pageoperator/pengunjung/index');
?>
