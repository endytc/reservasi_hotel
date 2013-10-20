<?php
if(!is_login()){
    ?><div class="alert alert-info">Untuk booking kamar anda harus <a href="<?php echo app_base_url('user/login')?>"  target="_blank"><b>login</b></a> terlebih dahulu. <br>
        Untuk registrasi silakan daftar <a href="<?php echo app_base_url('user/registrasi')?>"><b>di sini</b></a></div>
<div class="alert alert-block">
    <form method="POST">
    <?php 
    foreach ($_POST['kamar_list'] as $kamar){
        echo "<input type='hidden' name='kamar_list[]' value='$kamar'>";
    }?>
    Setelah login, tekan tombol refresh <button><i class="icon icon-refresh"></i> Refresh</button>
    </form>
</div>      
            <?php
}else{
    $user=  get_user_login();
    $checkIn=array(
        'masuk'=>"$_GET[tanggal_check_in] $_GET[jam_check_in]",
        'keluar'=>"$_GET[tanggal_check_out] $_GET[jam_check_out]",
        'id_pengunjung'=>$user['id'],
    );
    $selisih=  selisihJam($_GET['tanggal_check_in'], $_GET['tanggal_check_out'], $_GET['jam_check_in'], $_GET['jam_check_out']);
    $is_success=false;
    foreach($_POST['kamar_list'] as $kamar){
        $kelas=  _select_unique_result("select kelas.* from kamar join kelas on kelas.id=kamar.id_kelas 
            where kamar.id='$kamar'");
        
        $biaya=  floor($selisih/24)*$kelas['biaya_per_hari'];
        //jika sisa booking lebih dari 6 jam (tidak sampe satu hari)
        if($selisih%24>=6){
            $biaya+=$kelas['biaya_per_hari'];
        }else{
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
    redirect('checkin/detail_checkin');
}
?>
