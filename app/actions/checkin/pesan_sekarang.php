<?php
$user=  get_user_login();
$checkInList=  _select_arr("select detail_checkin.*,kamar.nama as kamar,kelas.nama as kelas from detail_checkin 
    join kamar on kamar.id=detail_checkin.id_kamar
    join kelas on kelas.id=kamar.id_kelas
    where id_pengunjung='$user[id]'
        and id_checkin is null
        ");


if(count($checkInList)>0)
    $checkInInsert=  _insert('checkin',array(
        'id_pengunjung'=>$user['id_pengunjung'],
        'status'=>'pending'
    ));
else{
    $_SESSION['failed']='Checkin gagal dilakukan';
    redirect('checkin/history_checkin');
}

if($checkInInsert){
    $idMaxCheckin=  _select_unique_result("select max(id) as id from checkin where id_pengunjung='$user[id_pengunjung]'");
    foreach ($checkInList as $key => $checkIn) {
        _update('detail_checkin', array('id_checkin'=>$idMaxCheckin[id]), "id='$checkIn[id]'");
    }
    $_SESSION['success']='Checkin berhasil dilakukan, silakan segera lakukan pembayaran';
    
    redirect('checkin/history_checkin');
}else{
    $_SESSION['failed']='Checkin gagal dilakukan';
    redirect('checkin/detail_checkin');
}

?>
