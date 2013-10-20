<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $fasilitas=  _select_arr("select fasilitas.*,fasilitas.id as id_fasilitas,kategori_fasilitas.nama as kategori 
        from fasilitas 
        join kategori_fasilitas on kategori_fasilitas.id=fasilitas.id_kategori
        limit $page,".  getPerPage());
    $pagging= pagination("select * from fasilitas", getPerPage());
?>
<h3>Fasilitas</h3>
<hr>
<a target="ajax-modal" href="<?php echo app_base_url('pageadmin/fasilitas/add')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah</a>
<br>
<br>
<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($fasilitas as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['nama'];?></td>
        <td><?php echo $data['kategori']?></td>
        <td align="right"><?php echo ($data['harga'])?></td>
        <td class="button">
            <a target="ajax-modal" href="<?php echo app_base_url("pageadmin/fasilitas/edit?id=$data[id]")?>" class="edit"><i class="icon icon-edit"></i></a>
            <a href="<?php echo app_base_url("pageadmin/fasilitas/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin akan menghapus fasilitas $data[nama]?" ?>')"class="hapus"><i class="icon icon-remove"></i></a>
        </td>
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>