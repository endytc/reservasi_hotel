<?php
if($_POST){
    unset($_POST['yt0']);
    $is_success=  _insert('setting', $_POST);
    if($is_success){
        $_SESSION['success']="Data setting berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data setting gagal ditambahkan";
    }
    redirect('pageadmin/setting/index');
}
?>
<form action="<?php echo app_base_url('pageadmin/setting/add')?>" method="POST" class="form-horizontal" id="kategoriartikel">
     <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah setting</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Kd</label>                
                    <div class="controls">
                        <input type="text" class="required" name="kd" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Keterangan</label>                
                    <div class="controls">
                        <input type="text" class="required" name="keterangan" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Isi</label>                
                    <div class="controls">
                        <input type="text" class="required" name="isi" value="">
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