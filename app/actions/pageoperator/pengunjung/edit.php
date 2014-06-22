<?php
$pengunjung=  _select_unique_result("select * from pengunjung where id=$_GET[id]");
if($_POST){
    
    $is_success=_update('pengunjung', $pengunjung, 'id='.$_GET['id']);
    if($is_success){
        $_SESSION['success']="Data pengunjung berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data pengunjung gagal diperbarui";
    }
    redirect('pageoperator/pengunjung/index');
}

?>
<form action="<?php echo app_base_url('pageoperator/pengunjung/edit').'?id='.$_GET['id']?>" method="POST" id="addpengunjung" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Edit pengunjung </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[nama]" value="<?php echo $pengunjung['nama']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Tanda Pengenal <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[tanda_pengenal]" value="<?php echo $pengunjung['tanda_pengenal']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">No Tanda Pengenal <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[no_tanda_pengenal]" value="<?php echo $pengunjung['no_tanda_pengenal']?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">No Hp. <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[no_hp]" value="<?php echo $pengunjung['no_hp']?>">
                    </div>    
                </div>
				<div class="control-group">
                    <label class="control-label required">Alamat <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[alamat]" value="<?php echo $pengunjung['alamat']?>">
                    </div>    
                </div>
				<div class="control-group">
                    <label class="control-label required">Status Berkeluarga <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[status]" value="<?php echo $pengunjung['status']?>">
                    </div>    
                </div>
				<div class="control-group">
                    <label class="control-label required">Jumlah Poin <span class="required">*</span></label>                
                    <div class="controls">
                        <input type="text" class="required" name="pengunjung[jumlah_poin]" value="<?php echo $pengunjung['jumlah_poin']?>">
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
        $('#addpengunjung').validate();
        $("#gambar").rules("add", {
            accept: "jpg|jpeg|png|ico|bmp"
        });
    });
</script>