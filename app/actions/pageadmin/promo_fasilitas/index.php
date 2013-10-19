<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $kelas=  _select_arr("select *,(select count(*) from promo_pengunjung where id_promo=promo.id) as jumlah_penerima from promo 
        limit $page,".  getPerPage());
    $pagging= pagination("select * from kelas", getPerPage());
    
?>
<h3>Promosi Fasilitas</h3>
<hr>
<a href="<?php echo app_base_url('pageadmin/promo_fasilitas/add')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah</a>
<br>
<br>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Isi</th>
        <th>Jumlah Penerima</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($kelas as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['judul'];?></td>
        <td><?php echo $data['isi'];?></td>
        <td><?php echo $data['jumlah_penerima'];?></td>
        
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