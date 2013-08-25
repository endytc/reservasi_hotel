<?php
$kelas=  _select_unique_result("select * from kelas where id=$_GET[id]");
if($_POST){
    if(isset($_FILES["gambar"]["name"]) && $_FILES["gambar"]["name"]!=''){
        if (file_exists("upload/" . $_FILES["gambar"]["name"])) {
            $_FILES["gambar"]["name"]=  date('dmY').'_'.time().'_'.$_FILES["gambar"]["name"];
        }
        unlink($kelas['gambar']);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/gambar_kamar/" . $_FILES["gambar"]["name"]);
        $_POST['kelas']['gambar']='upload/gambar_kamar/'.$_FILES["gambar"]['name'];
    }
    $kelas =$_POST['kelas'];

    $is_success=_update('kelas', $kelas, 'id='.$_GET['id']);
    if($is_success){
        $_SESSION['success']="Data kelas berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data kelas gagal diperbarui";
    }
    redirect('pageadmin/kelas/index');
}

?>
<form action="<?php echo app_base_url('pageadmin/kelas/edit').'?id='.$_GET['id']?>" method="POST" id="addkelas" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Edit Kelas Kamar </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="kelas[nama]" value="<?php echo $kelas['nama']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Biaya/hari <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required number" name="kelas[biaya_per_hari]" value="<?php echo $kelas['biaya_per_hari']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Gambar</label>                
                    <div class="controls">
                        <input type="file" name="gambar" id="gambar" value="" accept="image/*"/>
                        <div class="break alert alert-info" style="font: small;font-style: italic">*) kosongkan gambar jika tidak ingin diganti</div>
                        <?php
                        if ($kelas['gambar'] != '') {
                            ?><a class="kelas-fancybox" href="<?php echo app_base_url() . '/' . $kelas['gambar']; ?>"><img src="<?php echo app_base_url() . '/' . $kelas['gambar']; ?>" width="70"></a><?php
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
        $('#addkelas').validate();
        $("#gambar").rules("add", {
            accept: "jpg|jpeg|png|ico|bmp"
        });
    });
</script>