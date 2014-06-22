<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $admin=  _select_arr("select *,admin.id as id_admin from admin where type='admin'
        limit $page,".  getPerPage());
    $pagging= pagination("select * from admin", getPerPage());
?>
<h3>Admin</h3>
<hr>
<!--
<a target="ajax-modal" href="<?php echo app_base_url('pageadmin/admin/add')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah</a>
<br> 
-->
<br>
<table class="table table-striped table-bordered bootstrap-datatable table">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($admin as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['nama'];?></td>
        <td><?php echo $data['username']?></td>
        <td class="button">
            <a target="ajax-modal" href="<?php echo app_base_url("pageadmin/admin/edit?id=$data[id]")?>" class="edit"><i class="icon icon-edit"></i>edit</a>
         <!--   <a href="<?php echo app_base_url("pageadmin/admin/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin akan menghapus admin $data[nama]?" ?>')"class="hapus"><i class="icon icon-remove"></i></a>
       --> </td>
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>