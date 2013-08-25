<?php
if($_POST){
     if (file_exists("upload/" . $_FILES["gambar"]["name"])) {
        $_FILES["gambar"]["name"]=  date('dmY').'_'.time().'_'.$_FILES["gambar"]["name"];
    } 
    move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/gambar_bukti_transfer/" . $_FILES["gambar"]["name"]);
    $_POST['bayar']['gambar']='upload/gambar_bukti_transfer/'.$_FILES["gambar"]['name'];
    
    $is_success         = _insert('pembayaran', $_POST['bayar']);
    if($is_success){
        $_SESSION['success']="Data pembayaran berhasil ditambahkan";
    }else{  
        $_SESSION['failed']="Data pembayaran gagal ditambahkan";
    }
    redirect('checkin/history_checkin');
}
$checkIn=  _select_unique_result("select * from checkin where id='$_GET[id]'");
$tagihan= _select_unique_result("select sum(biaya) as tagihan from detail_checkin where id_checkin='$_GET[id]'");
$uangMuka=  _select_unique_result("select * from setting where kd='min_dp'");
$uangMuka=$uangMuka['isi'];
?>
<form action="<?php echo app_base_url('checkin/bayar')?>" method="POST" id="addbayar" class="form-horizontal"  enctype="multipart/form-data">
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
                        <label class="inline" ><?php echo rupiah($tagihan['tagihan'],false)?></label>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Minimal Uang Muka</label>                
                    <div class="controls">
                        <label class="inline" ><?php echo rupiah($tagihan['tagihan']*$uangMuka/100,false)?></label>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Nominal</label>                
                    <div class="controls">
                        <input type="text" class="required number" min="<?php echo ($tagihan['tagihan']*$uangMuka/100)-1?>"name="bayar[nominal]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Bank</label>                
                    <div class="controls">
                        <select name="bayar[id_bank]" class="required">
                            <option value="">- Pilih Bank -</option>
                            <?php
                            foreach(_select_arr("select*from bank") as $bank){
                                echo "<option value='$bank[id]'>$bank[nama_bank]-$bank[atas_nama] ($bank[no_rekening])</option>";
                            }
                            ?>
                        </select>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Keterangan </label>                
                    <div class="controls">
                        <textarea class="required" name="bayar[keterangan]" cols="10" style="width: 270px" rows="2"></textarea>
                    </div>    
                </div>
                 <div class="control-group">
                    <label class="control-label required">Bukti Pembayaran</label>                
                    <div class="controls">
                        <input type="file" name="gambar" id="gambar" value="" accept="image/*" class="required"/>
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