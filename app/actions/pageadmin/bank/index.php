<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $bank=  _select_arr("select *,bank.id as id_bank from bank 
        limit $page,".  getPerPage());
    $pagging= pagination("select * from bank", getPerPage());
?>
<h3>Kategori Fasilitas</h3>
<hr>
<a target="ajax-modal" href="<?php echo app_base_url('pageadmin/bank/add')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah</a>
<br>
<br>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>No</th>
        <th>Bank</th>
        <th>Atas Nama</th>
        <th>No. Rekening</th>
        <th>Icon</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($bank as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['nama_bank'];?></td>
        <td><?php echo $data['atas_nama'];?></td>
        <td><?php echo $data['no_rekening'];?></td>
        <td>
            <?php
                if($data['gambar']!=''){
                    ?><a class="bank-fancybox" target="blank" href="<?php echo app_base_url().'/'.$data['gambar'];?>"><img src="<?php echo app_base_url().'/'.$data['gambar'];?>" width="40"></a><?php
                }else{
                    ?><img src="<?php echo app_base_url().'/upload/not-found.png';?>" width="40"><?php
                }
            ?>
            
        </td>
        <td class="button">
            <a target="ajax-modal" href="<?php echo app_base_url("pageadmin/bank/edit?id=$data[id]")?>" class="edit"><i class="icon icon-edit"></i></a>
            <a href="<?php echo app_base_url("pageadmin/bank/delete?id=$data[id]")?>" onclick="return confirm('<?php echo "Apakah anda yakin akan menghapus bank $data[nama]?" ?>')"class="hapus"><i class="icon icon-remove"></i></a>
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
//    $('.bank-fancybox').fancybox({rel:'gal'});
})
</script>