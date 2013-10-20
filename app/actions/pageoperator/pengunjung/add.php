<?php
if($_POST){
    $is_success         = _insert('pengunjung', $_POST['pengunjung']);
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