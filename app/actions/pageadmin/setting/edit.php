<?php
if($_POST){
    unset($_POST['yt0']);
    $is_success=_update('setting', $_POST, 'kd="'.$_GET['kd'].'"');
    if($is_success){
        $_SESSION['success']="Data setting berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data setting gagal diperbarui";
    }
    redirect('pageadmin/setting/index');
}
$setting=  _select_unique_result("select * from setting where kd='$_GET[kd]'");
?>
<form action="<?php echo app_base_url('pageadmin/setting/edit?kd='.$_GET['kd'])?>" method="POST" class="form-horizontal" id="kategoriartikel">
     <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Edit setting</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Keterangan </label>                
                    <div class="controls">
                        <input type="text" class="required" name="keterangan" value="<?php echo $setting['keterangan']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Isi </label>                
                    <div class="controls">
                        <input type="text" class="required" name="isi" value="<?php echo $setting['isi']?>">
                    </div>    
                </div>
            </fieldset>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit" name="yt0">Simpan</button>            <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
    </div>    
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#kategoriartikel').validate();
    });
</script>