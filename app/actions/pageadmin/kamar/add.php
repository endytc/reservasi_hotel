<?php
if($_POST){
    $is_success         = _insert('kamar', $_POST['kamar']);
    if($is_success){
        $_SESSION['success']="Data kamar berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data kamar gagal ditambahkan";
    }
    redirect('pageadmin/kamar/index');
}
$kategoriList=  _select_arr("select*from kelas");
?>
<form action="<?php echo app_base_url('pageadmin/kamar/add')?>" method="POST" id="addkamar" class="form-horizontal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah Admin </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Nama </label>                
                    <div class="controls">
                        <input type="text" class="required" name="kamar[nama]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Kelas</label>                
                    <div class="controls">
                        <select class="required" name="kamar[id_kelas]">
                            <option value="">- Pilih Kelas -</option>
                            <?php foreach($kategoriList as $kategori){
                                echo "<option value='$kategori[id]'>$kategori[nama]</option>";
                            }
                            ?>
                        </select>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Keterangan </label>                
                    <div class="controls">
                        <textarea class="required" name="kamar[keterangan]" cols="30" rows="3"></textarea>
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
        $('#addkamar').validate();
    });
</script>