<?php
if($_POST){
    $_POST['admin']['password']=md5($_POST['admin']['password']);
    $_POST['admin']['type']='operator';
    $is_success         = _insert('admin', $_POST['admin']);
    if($is_success){
        $_SESSION['success']="Data operator berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data operator gagal ditambahkan";
    }
    redirect('pageadmin/operator/index');
}
?>
<form action="<?php echo app_base_url('pageadmin/operator/add')?>" method="POST" id="addadmin" class="form-horizontal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah operator </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="admin[nama]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Username <span class="required">*</span></label>                
                    <div class="controls">
                        
                        <input type="text" class="required" name="admin[username]" value="" placeholder="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Password <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="password" class="required" name="admin[password]" value="" id="password">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Ulangi Password <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="password" class="required" name="ulangi_password">
                    </div>    
                </div>
            </fieldset>
        </div><!-- form -->
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit" name="yt0">Tambah</button>            
    <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
</div>    
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#addadmin').validate({
            rules:{
                ulangi_password:{
                    equalTo:'#password'
                }
            },
            messages:{
                ulangi_password: 'Password not match'
            }
        });
    });
</script>