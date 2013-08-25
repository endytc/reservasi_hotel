<?php
if($_POST){
    $admin =$_POST['admin'];
    if($_POST['admin']['password']!=''){
        $_POST['admin']['password']=md5($_POST['admin']['password']);
    }else
        unset($_POST['admin']['password']);
    
    $is_success=_update('admin', $admin, 'id='.$_GET['id']);
    if($is_success){
        $_SESSION['success']="Data operator berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data operator gagal diperbarui";
    }
    redirect('pageadmin/operator/index');
}
$admin=  _select_unique_result("select * from admin where id=$_GET[id]");
?>
<form action="<?php echo app_base_url('pageadmin/operator/edit').'?id='.$_GET['id']?>" method="POST" id="addadmin" class="form-horizontal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Edit operator </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="admin[nama]" value="<?php echo $admin['nama']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Username <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="admin[username]" value="<?php echo $admin['username'];?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label">Password <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="password" class="" name="admin[password]" value="" id="password">
                        
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Ulangi Password <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="password" class="" name="ulangi_password">
                    </div>    
                </div>
                *) <i>Kosongi password jika tidak ingin diganti</i>
            </fieldset>
        </div><!-- form -->
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit" name="yt0">Simpan</button>            <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
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