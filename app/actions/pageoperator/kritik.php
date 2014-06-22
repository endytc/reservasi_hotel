<?php
    $page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
    $where="1";
    if(isset($_GET['nama_pengunjung']) && $_GET['nama_pengunjung']!=null){
        $where.=" and pengunjung.nama like '%$_GET[nama_pengunjung]%'";
    }
    $pengunjung=  _select_arr("select kritik.*,member.email,pengunjung.nama as pengunjung from kritik
        join member on id_member=member.id_pengunjung
        join pengunjung on member.id_pengunjung=pengunjung.id
     where $where
        limit $page,".  getPerPage());
    $pagging= pagination("select * from pengunjung", getPerPage());
?>
<h3>Kritik Dan Saran</h3>
<hr>
<!-- <div class="span2" style="text-align: left;display: inline">
    <a target="ajax-modal" href="<?php echo app_base_url('pageoperator/pengunjung/add')?>" class="btn btn-primary"><i class="icon icon-plus"></i> Tambah</a>
</div> -->
<!-- <div class="8" style="text-align: right;display: inline">
    <form>
        <div class="input-append">
            <input type="text" name="nama_pengunjung" id="nama_pengunjung" value="<?php echo isset($_GET['nama_pengunjung']) && $_GET['nama_pengunjung']!=null?$_GET['nama_pengunjung']:''?>"class="required" placeholder="Nama pengunjung" class="span2">
            <button class="btn-primary btn"><i class="icon icon-search"></i> Search</button>
            <input type="hidden" name="id_pengunjung" id="id_pengunjung" value="">
        </div>
    </form>
</div> -->

<table class="table table-bordered">
    <thead>
    <tr>
        <th style='width: 10%'>No</th>
        <th style='width: 10%'>Pengunjung</th>
        <th style='width: 10%'>Email</th>
        <th>Isi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=  $page+1;
    foreach($pengunjung as $data){
        ?>
    <tr>
        <td><?php echo $i++;?></td>
        <td><?php echo $data['pengunjung'];?></td>
        <td><?php echo $data['email'];?></td>
        <td><b>Kritik</b><br><?php echo $data['kritik']."<br> <b>Saran</b><br>$data[saran]";?></td>
        
    </tr>    
    </tbody>
        <?php
    }
    ?>
</table>
<?php echo $pagging?>
<script type="text/javascript">
$(document).ready(function(){
//    $('.pengunjung-fancybox').fancybox({rel:'gal'});
})
</script>