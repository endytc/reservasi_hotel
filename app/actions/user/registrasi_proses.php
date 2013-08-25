<?php
$pengunjungInsert=  _insert('pengunjung',$_POST['personal']);
$pengunjung=  _select_unique_result("select max(id) as id from pengunjung where nama='".$_POST['personal']['nama']."'");
$_POST['member']['id_pengunjung']=$pengunjung['id'];
$_POST['member']['password']=  md5($_POST['member']['password']);
if($pengunjungInsert)
    $memberInsert=  _insert('member',$_POST['member']);
if($memberInsert){
    $_SESSION['success']='Registrasi member '.$_POST['personal']['nama'].' '.' behasil dilakukan';
    redirect('');
}else{
    $_SESSION['success']='Registrasi member '.$_POST['personal']['nama'].' '.' gagal dilakukan';
    redirect(app_base_url('user/registrasi'));
}
?>
