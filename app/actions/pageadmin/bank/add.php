<?php
if($_POST){
    if (file_exists("upload/" . $_FILES["gambar"]["name"])) {
        $_FILES["gambar"]["name"]=  date('dmY').'_'.time().'_'.$_FILES["gambar"]["name"];
    } 
    move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/gambar_bank/" . $_FILES["gambar"]["name"]);
    $_POST['bank']['gambar']='upload/gambar_bank/'.$_FILES["gambar"]['name'];
    
    $is_success         = _insert('bank', $_POST['bank']);
    if($is_success){
        $_SESSION['success']="Data bank berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data bank gagal ditambahkan";
    }
    redirect('pageadmin/bank/index');
}
?>
<form action="<?php echo app_base_url('pageadmin/bank/add')?>" method="POST" id="addbank" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah Bank</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama Bank<span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="bank[nama_bank]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Atas Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="bank[atas_nama]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">No Rekening <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="bank[no_rekening]" value="">
                    </div>    
                </div>
                
                <div class="control-group">
                    <label class="control-label required">Icon</label>                
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
        $('#addbank').validate();  
         $("#gambar").rules("add", {
            accept: "jpg|jpeg|png|ico|bmp"
        });
    });
</script>