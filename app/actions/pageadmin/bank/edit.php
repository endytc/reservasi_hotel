<?php
$bank=  _select_unique_result("select * from bank where id=$_GET[id]");
if($_POST){
    if(isset($_FILES["gambar"]["name"]) && $_FILES["gambar"]["name"]!=''){
        if (file_exists("upload/" . $_FILES["gambar"]["name"])) {
            $_FILES["gambar"]["name"]=  date('dmY').'_'.time().'_'.$_FILES["gambar"]["name"];
        }
        unlink($bank['gambar']);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/gambar_bank/" . $_FILES["gambar"]["name"]);
        $_POST['bank']['gambar']='upload/gambar_bank/'.$_FILES["gambar"]['name'];
    }
    $bank =$_POST['bank'];

    $is_success=_update('bank', $bank, 'id='.$_GET['id']);
    if($is_success){
        $_SESSION['success']="Data bank berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data bank gagal diperbarui";
    }
    redirect('pageadmin/bank/index');
}

?>
<form action="<?php echo app_base_url('pageadmin/bank/edit').'?id='.$_GET['id']?>" method="POST" id="addbank" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Edit Bank </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
        <div class="control-group">
                    <label class="control-label required">Nama Bank<span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="bank[nama_bank]" value="<?php echo $bank['nama_bank']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Atas Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="bank[atas_nama]" value="<?php echo $bank['atas_nama']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">No Rekening <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="bank[no_rekening]" value="<?php echo $bank['no_rekening']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Icon</label>                
                    <div class="controls">
                        <input type="file" name="gambar" id="gambar" value="" accept="image/*"/>
                        <div class="break alert alert-info" style="font: small;font-style: italic">*) kosongkan gambar jika tidak ingin diganti</div>
                        <?php
                        if ($bank['gambar'] != '') {
                            ?><a class="bank-fancybox" href="<?php echo app_base_url() . '/' . $bank['gambar']; ?>"><img src="<?php echo app_base_url() . '/' . $bank['gambar']; ?>" width="70"></a><?php
                        } else {
                            ?><img src="<?php echo app_base_url() . '/upload/not-found.png'; ?>" width="40"><?php
                        }
                        ?>
                        
                    </div>    
                </div>
            </fieldset>
        </div><!-- form -->
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit" name="yt0">Simpan</button>            <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
</div>    
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#addbank').validate();
        $("#gambar").rules("add", {
            accept: "jpg|jpeg|png|ico|bmp"
        });
    });
</script>