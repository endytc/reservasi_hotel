<?php
if($_POST){
    if (file_exists("upload/" . $_FILES["gambar"]["name"])) {
        $_FILES["gambar"]["name"]=  date('dmY').'_'.time().'_'.$_FILES["gambar"]["name"];
    } 
    move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/gambar_kamar/" . $_FILES["gambar"]["name"]);
    $_POST['kelas']['gambar']='upload/gambar_kamar/'.$_FILES["gambar"]['name'];
    
    $is_success         = _insert('kelas', $_POST['kelas']);
    if($is_success){
        $_SESSION['success']="Data kelas berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data kelas gagal ditambahkan";
    }
    redirect('pageadmin/kelas/index');
}
?>
<form action="<?php echo app_base_url('pageadmin/kelas/add')?>" method="POST" id="addkelas" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah Kelas Kamar</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="kelas[nama]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Biaya/hari <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required number" name="kelas[biaya_per_hari]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Gambar</label>                
                    <div class="controls">
                        <input type="file" name="gambar" id="gambar" value="" accept="image/*"/>
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
        $('#addkelas').validate();  
         $("#gambar").rules("add", {
            accept: "jpg|jpeg|png|ico|bmp"
        });
    });
</script>