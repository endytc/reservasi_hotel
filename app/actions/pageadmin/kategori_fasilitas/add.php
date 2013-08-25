<?php
if($_POST){
    $is_success         = _insert('kategori_fasilitas', $_POST['kategori_fasilitas']);
    if($is_success){
        $_SESSION['success']="Data kategori_fasilitas berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data kategori_fasilitas gagal ditambahkan";
    }
    redirect('pageadmin/kategori_fasilitas/index');
}
?>
<form action="<?php echo app_base_url('pageadmin/kategori_fasilitas/add')?>" method="POST" id="addkategori_fasilitas" class="form-horizontal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah Kategori Fasilitas </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="kategori_fasilitas[nama]" value="">
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
        $('#addkategori_fasilitas').validate();
    });
</script>