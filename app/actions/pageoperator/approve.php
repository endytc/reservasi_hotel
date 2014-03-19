<?php
$checkIn=  _select_unique_result("select checkin.*,
    (select sum(nominal) from pembayaran where id_checkin=checkin.id) as jumlah_bayar,
    (select sum(biaya) from detail_checkin where id_checkin=checkin.id) as jumlah_tagihan
    from checkin where id='$_GET[id]'");
$dataUpdate=array('status'=>$_GET['status']);
//if($checkIn['jumlah_bayar']>=$checkIn['jumlah_tagihan']){
    $minPoin= _select_unique_result("select * from setting where kd='min_poin'");
    $poin   = floor($checkIn['jumlah_tagihan']/$minPoin['isi']);
//echo $checkIn['jumlah_tagihan'].' '.$minPoin['isi'].' '.$poin;exit;
//}
$success=_update('checkin', $dataUpdate, "id='$_GET[id]'");
if($success){
    if($poin==null || $poin=='')
        $poin=0;
    $pengunjung=_select_unique_result("select * from pengunjung where id='$checkIn[id_pengunjung]'");
    _update('pengunjung', array('jumlah_poin'=>$poin+$pengunjung['jumlah_poin']), "id=$checkIn[id_pengunjung]");
    $_SESSION['success']='Data berhasil diperbarui';
}else
    $_SESSION['failed']='Data gagal diperbarui';
redirect('pageoperator');
?>
