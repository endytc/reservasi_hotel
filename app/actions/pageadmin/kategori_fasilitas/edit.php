<?php
if($_POST){
    $kategori_fasilitas =$_POST['kategori_fasilitas'];

    $is_success=_update('kategori_fasilitas', $kategori_fasilitas, 'id='.$_GET['id']);
    if($is_success){
        $_SESSION['success']="Data kategori_fasilitas berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data kategori_fasilitas gagal diperbarui";
    }
    redirect('pageadmin/kategori_fasilitas/index');
}
$kategori_fasilitas=  _select_unique_result("select * from kategori_fasilitas where id=$_GET[id]");
?>
<form action="<?php echo app_base_url('pageadmin/kategori_fasilitas/edit').'?id='.$_GET['id']?>" method="POST" id="addkategori_fasilitas" class="form-horizontal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Edit Kategori Fasilitas </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="kategori_fasilitas[nama]" value="<?php echo $kategori_fasilitas['nama']?>">
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
        $('#addkategori_fasilitas').validate();
    });
</script>