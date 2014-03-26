<?php
if($_POST){
    if($_FILES["gambar"]["name"]!=''){
        if (file_exists("upload/" . $_FILES["gambar"]["name"])) {
           $_FILES["gambar"]["name"]=  date('dmY').'_'.time().'_'.$_FILES["gambar"]["name"];
       } 
       move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/gambar_bukti_transfer/" . $_FILES["gambar"]["name"]);
       $_POST['bayar']['gambar']='upload/gambar_bukti_transfer/'.$_FILES["gambar"]['name'];
    }
    if($_POST['bayar']['id_bank']=='')
        $_POST['bayar']['id_bank']=NULL;
    $is_success         = _insert('pembayaran', $_POST['bayar']);
    if($is_success){
        $_SESSION['success']="Data pembayaran berhasil ditambahkan";
    }else{  
        $_SESSION['failed']="Data pembayaran gagal ditambahkan";
    }
    redirect('pageoperator/detail_kunjungan?id='.$_POST['bayar']['id_checkin']);
}
$checkIn=  _select_unique_result("select * from checkin where id='$_GET[id]'");
$tagihan= _select_unique_result("
select checkin.*,
    (select count(*) from detail_checkin where id_checkin=checkin.id) as jumlah_kamar,
    ((select sum(biaya) from detail_checkin where detail_checkin.id_checkin=checkin.id)+
    IFNULL((select sum(biaya*qty) from fasilitas_pengunjung where fasilitas_pengunjung.id_checkin=checkin.id),0))as jumlah_tagihan,
    ((select sum(nominal) from pembayaran where id_checkin=checkin.id)) as jumlah_bayar,
    pengunjung.nama as pengunjung
    from checkin 
    join pengunjung on pengunjung.id=checkin.id_pengunjung
    where  checkin.id='$_GET[id]'");
$uangMuka=  _select_unique_result("select * from setting where kd='min_dp'");
$uangMuka=$uangMuka['isi'];
$tagihan['jumlah_bayar']=$tagihan['jumlah_bayar']+($tagihan['jumlah_poin']*$tagihan['nilai_poin']);
?>
<form action="<?php echo app_base_url('pageoperator/bayar')?>" method="POST" id="addbayar" class="form-horizontal"  enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Bayar</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <input type="hidden" name="bayar[id_checkin]" value="<?php echo $_GET['id']?>">
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Jumlah Tagihan</label>                
                    <div class="controls">
                        <label class="inline" ><?php echo rupiah($tagihan['jumlah_tagihan'],false);?></label>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Sisa</label>                
                    <div class="controls">
                        <label class="inline" ><?php echo rupiah($tagihan['jumlah_tagihan']-$tagihan['jumlah_bayar'],false)?></label>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Nominal</label>                
                    <div class="controls">
                        <input type="text" class="required number" value="<?php echo ($tagihan['jumlah_tagihan']-$tagihan['jumlah_bayar'])?>"name="bayar[nominal]" value="">
                        
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Bank</label>                
                    <div class="controls">
                        <select name="bayar[id_bank]" class="">
                            <option value="">- Pilih Bank -</option>
                            <?php
                            foreach(_select_arr("select*from bank") as $bank){
                                echo "<option value='$bank[id]'>$bank[nama_bank]-$bank[atas_nama] ($bank[no_rekening])</option>";
                            }
                            ?>
                        </select>
                        <br><i style="font-size: small">* kosongi jika pembayaran di kasir</i>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Keterangan </label>                
                    <div class="controls">
                        <textarea class="required" name="bayar[keterangan]" cols="10" style="width: 270px" rows="2"></textarea>
                    </div>    
                </div>
                 <div class="control-group">
                    <label class="control-label required">Bukti Pembahayaran</label>                
                    <div class="controls">
                        <input type="file" name="gambar" id="gambar" value="" accept="image/*" class=""/>
                    </div>    
                </div>
                
            </fieldset>
        </div><!-- form -->
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit" >Tambah</button>            
    <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
</div>    
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#addbayar').validate();
        $("#gambar").rules("add", {
            accept: "jpg|jpeg|png|ico|bmp"
        });
    });
</script>