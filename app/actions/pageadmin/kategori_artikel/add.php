<?php
if($_POST){
    unset($_POST['yt0']);
    $is_success=  _insert('kategori_artikel', $_POST);
    if($is_success){
        $_SESSION['success']="Data kategori artikel berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data kategori artikel gagal ditambahkan";
    }
    redirect('pageadmin/kategori_artikel/index');
}
?>
<form action="<?php echo app_base_url('pageadmin/kategori_artikel/add')?>" method="POST" class="form-horizontal" id="kategoriartikel">
     <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah Kategori Artikel</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama </label>                
                    <div class="controls">
                        <input type="text" class="required" name="nama" value="">
                    </div>    
                </div>
            </fieldset>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="yt0">Tambah</button>            <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
    </div>    
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#kategoriartikel').validate();
    });
</script>