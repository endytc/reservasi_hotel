<?php
    $checkIn=array(
        'masuk'=>"$_GET[tanggal_check_in] $_GET[jam_check_in]",
        'keluar'=>"$_GET[tanggal_check_out] $_GET[jam_check_out]",
    );
    $selisih=  selisihJam($_GET['tanggal_check_in'], $_GET['tanggal_check_out'], $_GET['jam_check_in'], $_GET['jam_check_out']);
    $is_success=false;
    foreach($_POST['kamar_list'] as $kamar){
        $kelas=  _select_unique_result("select kelas.* from kamar join kelas on kelas.id=kamar.id_kelas 
            where kamar.id='$kamar'");
        $biaya=($selisih/24)*$kelas['biaya_per_hari'];
        if($selisih%24>=6){
            $biaya+=$kelas['biaya_per_hari'];
        }elseif($selisih%24!=0){
            $biaya+=$kelas['biaya_per_hari']*0.5;
        }
        $checkIn['id_kamar']=$kamar;
        $checkIn['biaya']=$biaya;
        $is_success=_insert('detail_checkin', $checkIn);
    }
    if($is_success){
        $_POST['success']='Booking kamar berhasil dilakukan';
    }else{
        $_POST['failed']='Booking kamar gagal dilakukan';
    }
    redirect('pageoperator/kunjungan');
?>
