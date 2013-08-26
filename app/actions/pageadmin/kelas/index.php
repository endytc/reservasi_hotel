<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $kelas=  _select_arr("select *,kelas.id as id_kelas from kelas 
        limit $page,".  getPerPage());
    $pagging= pagination("select * from kelas", getPerPage());
?>
<h3>Kategori Fasilitas</h3>
<hr>
<a target="ajax-modal" href="<?php echo app_base_url('pageadmin/kelas/add')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah</a>
<br>
<br>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Biaya/hari</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($kelas as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['nama'];?></td>
        <td><?php echo $data['biaya_per_hari'];?></td>
        <td>
            <?php
                if($data['gambar']!=''){
                    ?><a class="kelas-fancybox" target="_blank"href="<?php echo app_base_url().'/'.$data['gambar'];?>"><img src="<?php echo app_base_url().'/'.$data['gambar'];?>" width="40"></a><?php
                }else{
                    ?><img src="<?php echo app_base_url().'/upload/not-found.png';?>" width="40"><?php
                }
            ?>
            
        </td>
        <td class="button">
            <a target="ajax-modal" href="<?php echo app_base_url("pageadmin/kelas/edit?id=$data[id]")?>" class="edit"><i class="icon icon-edit"></i></a>
            <a href="<?php echo app_base_url("pageadmin/kelas/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin akan menghapus kelas $data[nama]?" ?>')"class="hapus"><i class="icon icon-remove"></i></a>
        </td>
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>
<script type="text/javascript">
$(document).ready(function(){
//    $('.kelas-fancybox').fancybox({rel:'gal'});
})
</script>