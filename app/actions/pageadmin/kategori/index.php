<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $kategori=  _select_arr("select * from kategori limit $page,".  getPerPage());
    $pagging= pagination("select * from kategori", getPerPage());
?>
<h2 class="title">Data Kategori</h2>
<a href="<?php echo app_base_url('pageadmin/kategori/add')?>" class="btn btn-primary">Tambah</a>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($kategori as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['nama']?></td>
        <td class="button">
            <a href="<?php echo app_base_url("kategori/edit?id=$data[id]")?>" class="edit">edit</a>
            <a href="<?php echo app_base_url("kategori/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin akan menghapus kategori $data[nama]?" ?>')"class="hapus">hapus</a>
        </td>
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>