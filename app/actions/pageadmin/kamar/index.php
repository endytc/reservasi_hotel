<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $kamar=  _select_arr("select kamar.*,kamar.id as id_kamar,kelas.nama as kelas,kelas.biaya_per_hari 
        from kamar 
        join kelas on kelas.id=kamar.id_kelas
        limit $page,".  getPerPage());
    $pagging= pagination("select * from kamar", getPerPage());
?>
<h3>Kelas Kamar</h3>
<hr>
<a target="ajax-modal" href="<?php echo app_base_url('pageadmin/kamar/add')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah</a>
<br>
<br>
<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($kamar as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['nama'];?></td>
        <td><?php echo $data['kelas']?></td>
        <td align="right"><?php echo ($data['biaya_per_hari'])?></td>
        <td class="button">
            <a target="ajax-modal" href="<?php echo app_base_url("pageadmin/kamar/edit?id=$data[id]")?>" class="edit"><i class="icon icon-edit"></i></a>
            <a href="<?php echo app_base_url("pageadmin/kamar/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin akan menghapus kamar $data[nama]?" ?>')"class="hapus"><i class="icon icon-remove"></i></a>
        </td>
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>