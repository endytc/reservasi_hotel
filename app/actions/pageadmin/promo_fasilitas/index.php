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
        <th>Nominal</th>
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
        <td><?php 
        if($data['transaksi_min']>0 && $data['transaksi_max']>0){
            echo rupiah($data['transaksi_min']).' s.d '.rupiah($data['transaksi_max']);
        }elseif($data['transaksi_min']==0 && $data['transaksi_max']==0){
            echo "Semua menerima";
        }
        elseif($data['transaksi_max']==0){
            echo "Min ".rupiah($data['transaksi_min']);
        }elseif($data['transaksi_min']==0){
            echo "Max ".rupiah($data['transaksi_max']);
        }        

            ?>
        </td>
        <td><?php echo $data['isi'];?></td>
        <td>
            <a href="<?php echo app_base_url('pageadmin/promo_fasilitas/view_penerima_promo')."?id=".$data['id']?>" target="ajax-modal">
                <?php echo $data['jumlah_penerima'];?>
            </a>
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