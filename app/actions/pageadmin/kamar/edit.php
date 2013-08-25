<?php
if($_POST){
    $kamar =$_POST['kamar'];
    if($_POST['kamar']['password']!=''){
        $_POST['kamar']['password']=md5($_POST['kamar']['password']);
    }else
        unset($_POST['kamar']['password']);
    
    $is_success=_update('kamar', $kamar, 'id='.$_GET['id']);
    if($is_success){
        $_SESSION['success']="Data kamar berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data kamar gagal diperbarui";
    }
    redirect('pageadmin/kamar/index');
}
$kamar=  _select_unique_result("select * from kamar where id=$_GET[id]");
$kategoriList=  _select_arr("select*from kelas");
?>
<form action="<?php echo app_base_url('pageadmin/kamar/edit').'?id='.$_GET['id']?>" method="POST" id="addkamar" class="form-horizontal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Edit Fasilitas</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama </label>                
                    <div class="controls">
                        <input type="text" class="required" name="kamar[nama]" value="<?php echo $kamar["nama"]?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Kelas</label>                
                    <div class="controls">
                        <select class="required" name="kamar[id_kelas]">
                            <option value="">- Pilih Kelas -</option>
                            <?php foreach($kategoriList as $kategori){
                                $selected=($kategori['id']==$kamar['id_kelas'])?'selected':'';
                                echo "<option value='$kategori[id]' $selected>$kategori[nama]</option>";
                            }
                            ?>
                        </select>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Keterangan </label>                
                    <div class="controls">
                        <textarea class="required" name="kamar[keterangan]" cols="30" rows="3"><?php echo $kamar["keterangan"]?></textarea>
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
        $('#addkamar').validate({
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