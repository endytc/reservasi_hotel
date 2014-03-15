<?php
if($_POST){
    $is_success         = _insert('pengunjung', $_POST['pengunjung']);
    if(isset($_POST['member']) && $_POST['member']['email']!=''){
        $id_pengunjung=_select_max_id('pengunjung','id');
        $_POST['member']['id_pengunjung']=$id_pengunjung;
        $_POST['member']['password']=md5($_POST['member']['password']);

        _insert('member',$_POST['member']);
    }
    if($is_success){
        $_SESSION['success']="Data pengunjung berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data pengunjung gagal ditambahkan";
    }
    redirect('pageoperator/pengunjung/index');
}
?>
<form action="<?php echo app_base_url('pageoperator/pengunjung/add')?>" method="POST" id="add-pengunjung" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah pengunjung</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[nama]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Alamat <span class="required">*</span></label>
                    <div class="controls">
                        <textarea class="required" name="pengunjung[alamat]" style="width: 70%"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label required">Tanda Pengenal <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[tanda_pengenal]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">No Tanda Pengenal <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[no_tanda_pengenal]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">No Hp. <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[no_hp]" value="">
                    </div>    
                </div>
                <hr>
                <div class="control-group">
                    <label class="control-label required">Username</label>
                    <div class="controls">
                        <input type="text" class="" name="member[username]" value="">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label required">Password</label>
                    <div class="controls">
                        <input type="password" class="" name="member[password]" value="grahaprima">
                        <br><i>*) Default grahaprima</i>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label required">Email </label>
                    <div class="controls">
                        <input type="text" class="" name="member[email]" value="">
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
        $('#add-pengunjung').validate();  
    });
</script>