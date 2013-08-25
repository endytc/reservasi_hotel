<?php
if($_POST){
    $is_success=_update('kategori', $_POST, 'id='.$_GET['id']);
    if($is_success){
        $_SESSION['success']="Data kategori berhasil diperbarui";
    }else{
        $_SESSION['failed']="Data kategori gagal diperbarui";
    }
    redirect('pageadmin/kategori/index');
}
$kategori=  _select_unique_result("select * from kategori where id=$_GET[id]");
?>
<h2 class="title">Edit Kategori</h2>
<form action="<?php echo app_base_url('kategori/edit?id='.$_GET['id'])?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $_GET['id']?>"/>
    <table class="data-form">
        <tr>
            <td class="title">Nama</td>
            <td><input type="text" name="nama" value="<?php echo $kategori['nama']?>"/></td>
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