<?php
$detailCheckin=  _select_unique_result("select *,
    date(keluar) as tanggal_keluar, time(keluar) as jam_keluar, 
    date(masuk) as tanggal_masuk, time(masuk) as jam_masuk 
    from detail_checkin 
    where id='$_GET[id_check_in_list]'");
//show_array($detailCheckin);exit;
if($_POST){
    $_POST['tanggal_check_out']=  date2mysql($_POST['tanggal_check_out']);
    $checkIn=array(
        'keluar'=>"$_POST[tanggal_check_out] $_POST[jam_check_out]",
    );
    
    $selisih=  selisihJam($detailCheckin['tanggal_masuk'], $_POST['tanggal_check_out'], $detailCheckin['jam_masuk'], $_POST['jam_check_out']);
//    echo $selisih;
//    show_array($_POST);exit;
    $is_success=false;
    
    $kamar=$detailCheckin['id_kamar'];
        $kelas=  _select_unique_result("select kelas.* from kamar join kelas on kelas.id=kamar.id_kelas 
            where kamar.id='$kamar'");
        $biaya=($selisih/24)*$kelas['biaya_per_hari'];
        if($selisih%24>=6){
            $biaya+=$kelas['biaya_per_hari'];
        }else{
            $biaya+=$kelas['biaya_per_hari']*0.5;
        }
        $checkIn['id_kamar']=$kamar;
        $checkIn['biaya']=$biaya;
        
        $is_success=  _update('detail_checkin', $checkIn,"id=$_GET[id_check_in_list]");
    
    if($is_success){
        $_POST['success']='Booking kamar berhasil dilakukan';
    }else{
        $_POST['failed']='Booking kamar gagal dilakukan';
    }
//    exit;   
    redirect('pageoperator/detail_kunjungan?id='.$_GET['id']);
}

if(isset($_GET['act']) && $_GET['act']=='cek'){
    $where="1=1";
    $detailCheckin['keluar']=  date2mysql($_GET['tanggal_check_out'])." ".$_GET['jam_check_out'];
    $qry="select id_kamar from 
                    detail_checkin c 
                join checkin on checkin.id=c.id_checkin    
                where 
                    ((c.masuk<'$detailCheckin[masuk]' AND c.keluar>'$detailCheckin[masuk]') OR
                    (c.masuk<'$detailCheckin[keluar]' AND c.keluar>'$detailCheckin[keluar]') 
                     OR (c.masuk>'$detailCheckin[masuk]' AND c.keluar<'$detailCheckin[keluar]')   
                     OR (c.masuk='$detailCheckin[masuk]' AND c.keluar='$detailCheckin[keluar]'))    
                        AND checkin.status<>'unapproved'
                and c.id<>'$_GET[id_check_in_list]'        
    ";
    $kamarList = _select_arr($qry);
    
    echo (count($kamarList)>0)?'false':'true';
    exit;
}
?>
<form action="<?php echo app_base_url('pageoperator/tambah_jam?id='.$_GET['id']."&id_check_in_list=$_GET[id_check_in_list]")?>" method="POST" id="tambah-jam" class="form-horizontal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah Jam </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Checkout</label>                
                    <div class="controls">
                        <!--<div class="input-append">-->
                        <input type="text" name="tanggal_check_out" value="<?php echo datefmysql($detailCheckin['tanggal_keluar'])?>" id="tanggal_checkout" class="span2 required">
                        <input type="text" name="jam_check_out" value="<?php echo ($detailCheckin['jam_keluar'])?>" class="span2 required" placeholder="24:00"> 
                        <!--</div>-->    
                    </div>    
                </div>                
            </fieldset>
        </div><!-- form -->
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit" name="yt0">Tambah</button>            <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
</div>    
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tambah-jam').validate({
            rules:{
               jam_check_out:{
                   remote:{
                       url:'<?php echo app_base_url('pageoperator/tambah_jam')."?act=cek&id=".
                               $_GET['id']."&id_check_in_list=$_GET[id_check_in_list]"?>',
                       data:{
                            tanggal_check_out:function(){ return $('input[name=tanggal_check_out]').attr('value')}
                       }
                   }
               }, 
               tanggal_check_out:{
                   remote:{
                       url:'<?php echo app_base_url('pageoperator/tambah_jam')."?act=cek&id=".
                               $_GET['id']."&id_check_in_list=$_GET[id_check_in_list]"?>',
                       data:{
                            jam_check_out:function(){ return $('input[name=jam_check_out]').attr('value')}
                       }
                   }
               }
            },
            messages:{
                jam_check_out:"Jam checkout dipakai, silakan pilih jam lain",
                tanggal_check_out:"Jam checkout dipakai, silakan pilih jam lain"
            }
        });
        
        $('#tanggal_checkout').datepicker();
    });
</script>