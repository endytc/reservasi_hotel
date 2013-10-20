<?php
if($_POST){
     if (file_exists("upload/" . $_FILES["gambar"]["name"])) {
        $_FILES["gambar"]["name"]=  date('dmY').'_'.time().'_'.$_FILES["gambar"]["name"];
    } 
    move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/gambar_fasilitas/" . $_FILES["gambar"]["name"]);
    $_POST['fasilitas']['gambar']='upload/gambar_fasilitas/'.$_FILES["gambar"]['name'];
    
    $is_success         = _insert('fasilitas', $_POST['fasilitas']);
    if($is_success){
        $_SESSION['success']="Data fasilitas berhasil ditambahkan";
    }else{  
        $_SESSION['failed']="Data fasilitas gagal ditambahkan";
    }
    redirect('pageadmin/fasilitas/index');
}
$kategoriList=  _select_arr("select*from kategori_fasilitas");
?>
<form action="<?php echo app_base_url('pageadmin/fasilitas/add')?>" method="POST" id="addfasilitas" class="form-horizontal"  enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah Fasilitas </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama </label>                
                    <div class="controls">
                        <input type="text" class="required" name="fasilitas[nama]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Kategori</label>                
                    <div class="controls">
                        <select class="required" name="fasilitas[id_kategori]">
                            <option value="">- Pilih Kategori -</option>
                            <?php foreach($kategoriList as $kategori){
                                echo "<option value='$kategori[id]'>$kategori[nama]</option>";
                            }
                            ?>
                        </select>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Harga </label>                
                    <div class="controls">
                        <input type="text" class="required number" name="fasilitas[harga]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Keterangan </label>                
                    <div class="controls">
                        <textarea class="required" name="fasilitas[keterangan]" cols="10" style="width: 270px" rows="2"></textarea>
                    </div>    
                </div>
                 <div class="control-group">
                    <label class="control-label required">Icon</label>                
                    <div class="controls">
                        <input type="file" name="gambar" id="gambar" value="" accept="image/*"/>
                        
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
        $('#addfasilitas').validate();
        $("#gambar").rules("add", {
            accept: "jpg|jpeg|png|ico|bmp"
        });
    });
</script>