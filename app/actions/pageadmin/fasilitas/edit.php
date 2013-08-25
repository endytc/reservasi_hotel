<?php
$fasilitas=  _select_unique_result("select * from fasilitas where id=$_GET[id]");
if($_POST){
    if(isset($_FILES["gambar"]["name"]) && $_FILES["gambar"]["name"]!=''){
        if (file_exists("upload/" . $_FILES["gambar"]["name"])) {
            $_FILES["gambar"]["name"]=  date('dmY').'_'.time().'_'.$_FILES["gambar"]["name"];
        }
        unlink($fasilitas['gambar']);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/gambar_fasilitas/" . $_FILES["gambar"]["name"]);
        $_POST['fasilitas']['gambar']='upload/gambar_fasilitas/'.$_FILES["gambar"]['name'];
    }
    $fasilitas =$_POST['fasilitas'];
    
    $is_success=_update('fasilitas', $fasilitas, 'id='.$_GET['id']);
    if($is_success){
        $_SESSION['success']="Data fasilitas berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data fasilitas gagal diperbarui";
    }
    redirect('pageadmin/fasilitas/index');
}

$kategoriList=  _select_arr("select*from kategori_fasilitas");
?>
<form action="<?php echo app_base_url('pageadmin/fasilitas/edit').'?id='.$_GET['id']?>" method="POST" id="addfasilitas" class="form-horizontal"  enctype="multipart/form-data">
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
                        <input type="text" class="required" name="fasilitas[nama]" value="<?php echo $fasilitas["nama"]?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Kategori</label>                
                    <div class="controls">
                        <select class="required" name="fasilitas[id_kategori]">
                            <option value="">- Pilih Kategori -</option>
                            <?php foreach($kategoriList as $kategori){
                                $selected=($kategori['id']==$fasilitas['id_kategori'])?'selected':'';
                                echo "<option value='$kategori[id]' $selected>$kategori[nama]</option>";
                            }
                            ?>
                        </select>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Harga </label>                
                    <div class="controls">
                        <input type="text" class="required number" name="fasilitas[harga]" value="<?php echo $fasilitas["harga"]?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Keterangan </label>                
                    <div class="controls">
                        <textarea class="required" name="fasilitas[keterangan]" cols="10" style="width: 270px" rows="2"><?php echo $fasilitas["keterangan"]?></textarea>
                    </div>    
                </div>
                 <div class="control-group">
                    <label class="control-label required">Icon</label>                
                    <div class="controls">
                        <input type="file" name="gambar" id="gambar" value="" accept="image/*"/>
                        <div class="break alert alert-info" style="font: small;font-style: italic">*) kosongkan gambar jika tidak ingin diganti</div>
                        <?php
                        if ($fasilitas['gambar'] != '') {
                            ?><a class="fasilitas-fancybox" href="<?php echo app_base_url() . '/' . $fasilitas['gambar']; ?>"><img src="<?php echo app_base_url() . '/' . $fasilitas['gambar']; ?>" width="70"></a><?php
                        } else {
                            ?><img src="<?php echo app_base_url() . '/upload/not-found.png'; ?>" width="40"><?php
                        }
                        ?>
                        
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
        $('#addfasilitas').validate();
        $("#gambar").rules("add", {
            accept: "jpg|jpeg|png|ico|bmp"
        });
    });
</script>