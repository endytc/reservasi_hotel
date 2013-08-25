<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $artikel=  _select_arr("select artikel.*, kategori.nama as kategori from artikel 
        join kategori_artikel kategori on kategori.id=artikel.id_kategori
        limit $page,".  getPerPage());
    $pagging= pagination("select * from artikel", getPerPage());
?>
<h2 class="title">Data Artikel</h2>
<hr>
<a href="<?php echo app_base_url('pageadmin/artikel/add')?>" class="btn btn-primary">+ Tambah</a>
<br><br>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($artikel as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['judul']?></td>
        <td><?php echo $data['kategori']?></td>
        <td class="button">
            <a href="<?php echo app_base_url("pageadmin/artikel/edit?id=$data[id]")?>" class=""><i class="icon icon-edit"></i></a>
            <a href="<?php echo app_base_url("pageadmin/artikel/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin akan menghapus artikel $data[judul]?" ?>')" class=""><i class="icon icon-remove-circle"></i></a>
        </td>
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>