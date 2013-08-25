<?php
if($_POST){
    $is_success=  _insert('kategori', $_POST);
    if($is_success){
        $_SESSION['success']="Data kategori berhasil ditambahkan";
    }else{
        $_SESSION['failed']="Data kategori gagal ditambahkan";
    }
    redirect('pageadmin/kategori/index');
}
?>
<h2 class="title">Tambah Kategori</h2>
<form action="<?php echo app_base_url('kategori/add')?>" method="POST">
    <table class="data-form">
        <tr>
            <td class="title">Nama</td>
            <td><input type="text" name="nama" value=""/></td>
        </tr>
    </table>
    <div class="buttonpane">
    <span class="ButtonInput">
        <span><input type="submit" value="Simpan"/></span>
    </span>
        <a href="<?php echo app_base_url('kategori/index')?>" class="Button"><span>Batal</span></a>
    </div>
</form>
<?php split_content()?>
<?php include_once 'app/actions/kategori/index.php';?>