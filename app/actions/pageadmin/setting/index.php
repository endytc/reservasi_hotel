<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $setting=  _select_arr("select *
        from setting 
        limit $page,".  getPerPage());
    $pagging= pagination("select * from setting", getPerPage());
?>
<h2 class="title">Data setting</h2>
<hr>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Kd</th>
        <th>Keterangan</th>
        <th>Isi</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($setting as $data){
        ?>
    <tr>
        <td><?php echo $data['kd']?></td>
        <td><?php echo $data['keterangan']?></td>
        <td><?php echo $data['isi']?></td>
        <td class="button">
            <a href="<?php echo app_base_url("pageadmin/setting/edit?kd=$data[kd]")?>" target="ajax-modal"><i class="icon icon-edit"></i></a>
            <a href="<?php echo app_base_url("pageadmin/setting/delete?kd=$data[kd]")?>" onclick="return confirm('<?php echo "Apakah anda yakin?" ?>')"><i class="icon icon-remove-circle"></i></a>
        </td>
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>