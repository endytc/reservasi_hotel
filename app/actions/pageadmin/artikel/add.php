<?php
if($_POST){
//    show_array($_FILES);
    if (file_exists("upload/artikel/" . $_FILES["gambar"]["name"])) {
        $_FILES["gambar"]["name"]=  date('dmY').'_'.time().'_'.$_FILES["gambar"]["name"];
    } 
    move_uploaded_file($_FILES["gambar"]["tmp_name"], "upload/artikel/" . $_FILES["gambar"]["name"]);
    $_POST['path_gambar']='upload/artikel/'.$_FILES["gambar"]['name'];
//    show_array($_POST);exit;
    $is_success=  _insert('artikel', $_POST);
    if($is_success){
        $_SESSION['success']="Data artikel berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data artikel gagal ditambahkan";
    }
    redirect('pageadmin/artikel/index');
}

$kategoriList=  _select_arr("select * from kategori_artikel");

?>
<h2 class="title">Tambah Artikel</h2>
<hr>
<form action="<?php echo app_base_url('pageadmin/artikel/add')?>" method="POST" enctype="multipart/form-data">
    <table class="data-form">
        <tr>
            <td class="title">Judul</td>
            <td><input type="text" name="judul" value="" class="required"/></td>
        </tr>
        <tr>
            <td class="title">Kategori</td>
            <td>
                <select name="id_kategori" class="required">
                    <option>- Pilih Kategori -</option>
                    <?php foreach($kategoriList as $k){
                        echo "<option value='$k[id]'>$k[nama]</option>";
                    }
?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="title">Gambar</td>
            <td><input type="file" name="gambar" value="" accept="image/*"/></td>
        </tr>
        <tr>
            <td class="title">Publish</td>
            <td>
                <input type="radio" name="is_published" value="1" checked="checked" style="width: auto"> Ya &nbsp;&nbsp;
                <input type="radio" name="is_published" value="0" style="width: auto"> Tidak 
            </td>
        </tr>
        <tr>
            <td colspan="2"><textarea name="isi" class="tinymce" style="width: 100%"></textarea></td>
        </tr>
    </table>
    <div class="modal-footer">
        <input type="submit" value="Simpan" class="btn btn-primary"/>
        <a href="<?php echo app_base_url('pageadmin/artikel/index')?>" class="btn btn-warning"><span>Batal</span></a>
    </div>
</form>