<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $kategori_fasilitas=  _select_arr("select *,kategori_fasilitas.id as id_kategori_fasilitas from kategori_fasilitas 
        limit $page,".  getPerPage());
    $pagging= pagination("select * from kategori_fasilitas", getPerPage());
?>
<h3>Kategori Fasilitas</h3>
<hr>
<a target="ajax-modal" href="<?php echo app_base_url('pageadmin/kategori_fasilitas/add')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah</a>
<br>
<br>
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
    foreach($kategori_fasilitas as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['nama'];?></td>
        <td class="button">
            <a target="ajax-modal" href="<?php echo app_base_url("pageadmin/kategori_fasilitas/edit?id=$data[id]")?>" class="edit"><i class="icon icon-edit"></i></a>
            <a href="<?php echo app_base_url("pageadmin/kategori_fasilitas/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin akan menghapus kategori_fasilitas $data[nama]?" ?>')"class="hapus"><i class="icon icon-remove"></i></a>
        </td>
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>