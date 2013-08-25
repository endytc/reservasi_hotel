<?php
if($_POST){
    $is_success=_update('artikel', $_POST, 'id='.$_GET['id']);
    if($is_success){
        $_SESSION['success']="Data artikel berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data artikel gagal diperbarui";
    }
    redirect('pageadmin/artikel/index');
}
$kategoriList=  _select_arr("select * from kategori_artikel");
$artikel=  _select_unique_result("select * from artikel where id=$_GET[id]");
?>
<h2 class="title">Edit Artikel</h2>
<br>
<form action="<?php echo app_base_url('pageadmin/artikel/edit?id='.$_GET['id'])?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $_GET['id']?>"/>
    <table class="data-form">
        <tr>
            <td class="title">Judul</td>
            <td><input type="text" name="judul" value="<?php echo $artikel['judul']?>" class="required"/></td>
        </tr>
        <tr>
            <td class="title">Kategori</td>
            <td>
                <select name="id_kategori" class="required">
                    <option>- Pilih Kategori -</option>
                    <?php foreach($kategoriList as $k){
                        $selected=($k['id']==$artikel['id_kategori'])?'selected':'';
                        echo "<option value='$k[id]' $selected>$k[nama]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="title">Gambar</td>
            <td>
                <input type="file" name="gambar" value="" accept="image/*"/><br>
                <i>*) kosongkan, jika gambar tidak ingin diganti</i>
            </td>
        </tr>
        <tr>
            <td class="title">Publish</td>
            <td>
                <input type="radio" name="is_published" value="1" <?php echo ($artikel['is_published'])?'checked="checked"':''?> style="width: auto"> Ya &nbsp;&nbsp;
                <input type="radio" name="is_published" value="0" <?php echo (!$artikel['is_published'])?'checked="checked"':''?> style="width: auto"> Tidak 
            </td>
        </tr>
        <tr>
            <td colspan="2"><textarea name="isi" class="tinymce" style="width: 100%"><?php echo $artikel['isi']?></textarea></td>
        </tr>
    </table>
    <div class="modal-footer" >
        <input type="submit" value="Simpan" class="btn btn-primary"/>
        <a href="<?php echo app_base_url('pageadmin/artikel/index')?>" class="btn btn-warning"><span>Batal</span></a>
    </div>
</form>