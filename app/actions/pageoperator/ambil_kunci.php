<?php
$where=1;
if(isset($_GET['id_kamar'])){
    $where.=" and id_kamar=$_GET[id_kamar]";
}
mysql_query("update detail_checkin set waktu_mengambil_kunci=now()
where id_checkin='$_GET[id]' and waktu_mengambil_kunci is null and $where ");
$_SESSION['success']="Kunci berhasil diambil";
redirect('pageoperator/detail_kunjungan?id='.$_GET['id']);