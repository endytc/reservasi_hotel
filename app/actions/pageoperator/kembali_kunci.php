<?php
$where=1;
if(isset($_GET['id_kamar'])){
    $where.=" and id=$_GET[id_detail]";
}
mysql_query("update detail_checkin set waktu_mengembalikan_kunci=now()
where id_checkin='$_GET[id]' and waktu_mengembalikan_kunci is null and $where ");
$_SESSION['success']="Kunci berhasil dikembalikan";
redirect('pageoperator/detail_kunjungan?id='.$_GET['id']);