<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $kategori_artikel=  _select_arr("select *,(select count(*) from artikel where artikel.id_kategori=kategori_artikel.id) as jumlah_artikel
        from kategori_artikel 
        limit $page,".  getPerPage());
    $pagging= pagination("select * from kategori_artikel", getPerPage());
?>
<h2 class="title">Data Kategori Artikel</h2>
<hr>
<a href="<?php echo app_base_url('pageadmin/kategori_artikel/add')?>" target="ajax-modal" class="btn btn-primary">+ Tambah</a>
<br><br>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jumlah Artikel</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($kategori_artikel as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['nama']?></td>
        <td><?php echo $data['jumlah_artikel']?></td>
        <td class="button">
            <a href="<?php echo app_base_url("pageadmin/kategori_artikel/edit?id=$data[id]")?>" target="ajax-modal"><i class="icon icon-edit"></i></a>
            <a href="<?php echo app_base_url("pageadmin/kategori_artikel/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin?" ?>')"><i class="icon icon-remove-circle"></i></a>
        </td>
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>