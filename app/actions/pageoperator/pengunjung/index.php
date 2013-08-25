<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $pengunjung=  _select_arr("select *,pengunjung.id as id_pengunjung from pengunjung 
        limit $page,".  getPerPage());
    $pagging= pagination("select * from pengunjung", getPerPage());
?>
<h3>Kategori Fasilitas</h3>
<hr>
<a target="ajax-modal" href="<?php echo app_base_url('pageoperator/pengunjung/add')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah</a>
<br>
<br>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>No Hp</th>
        <th>Tanda Pengenal</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($pengunjung as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['nama'];?></td>
        <td><?php echo $data['no_hp'];?></td>
        <td><?php echo $data['tanda_pengenal']."<br>No. $data[no_tanda_pengenal]";?></td>
        <td><?php echo $data['alamat'];?></td>
        <td class="button">
            <a target="ajax-modal" href="<?php echo app_base_url("pageoperator/pengunjung/edit?id=$data[id]")?>" class="edit"><i class="icon icon-edit"></i></a>
            <a href="<?php echo app_base_url("pageoperator/pengunjung/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin akan menghapus pengunjung $data[nama]?" ?>')"class="hapus"><i class="icon icon-remove"></i></a>
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
    $('.pengunjung-fancybox').fancybox({rel:'gal'});
})
</script>