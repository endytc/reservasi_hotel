<?php
$where = '1=1';
$having = '1=1';
//$statusChecked='';
//$isLunasChecked='';
if (isset($_GET['status']) && $_GET['status'] != ''){
    $where.=" and checkin.status='$_GET[status]'";
    $statusChecked=$_GET['status'];
}
if (isset($_GET['id_pengunjung']) && $_GET['id_pengunjung'] != ''){
    $where.=" and checkin.id_pengunjung='$_GET[id_pengunjung]'";
}
if (isset($_GET['booked_via']) && $_GET['booked_via'] != ''){
    $where.=" and checkin.booked_via='$_GET[booked_via]'";
    $viaChecked=$_GET['booked_via'];
}
if (isset($_GET['isLunas']) && $_GET['isLunas'] != '') {
    if ($_GET['isLunas'] == 'lunas')
        $having.=" and jumlah_bayar=jumlah_tagihan";
    else if ($_GET['isLunas'] == 'belum_lunas') {
        $having.=" and jumlah_bayar<jumlah_tagihan";
    }
    else if ($_GET['isLunas'] == 'belum_bayar') {
        $having.=" and (jumlah_bayar is null or jumlah_bayar=0)";
    }
    $isLunasChecked=$_GET['isLunas'];
}
$checkInList = _select_arr("select checkin.*,
    (select count(*) from detail_checkin where id_checkin=checkin.id) as jumlah_kamar,
    ((select sum(biaya) from detail_checkin where detail_checkin.id_checkin=checkin.id)+
    IFNULL((select sum(biaya*qty) from fasilitas_pengunjung where fasilitas_pengunjung.id_checkin=checkin.id),0))as jumlah_tagihan,
    (select sum(nominal) from pembayaran where id_checkin=checkin.id) as jumlah_bayar,
    pengunjung.nama as pengunjung
    from checkin 
    join pengunjung on pengunjung.id=checkin.id_pengunjung
    where $where 
    having $having
    order by checkin.waktu desc
    ");
$pilihanStatus = array('' => '- Semua -','pending' => 'Pending',
    'approved' => 'Approve', 'unapproved' => 'Unapproved    ',
);
$pilihanLunas = array('' => '- Semua -', 'lunas' => 'Lunas', 'belum_lunas' => 'Belum Lunas','belum_bayar'=>'Belum Dibayar'
);
$pilihanVia=array(''=>'- Semua -','online'=>'Online','offline'=>'Offline');
?>
<div class="span2" style="text-align: left">
    <a href="<?php echo app_base_url('pageoperator/kunjungan')?>" class="btn btn-primary">
        <i class="icon icon-plus-sign"></i> Tambah
    </a>
</div>    
<div class="9" style="text-align: right">
    <form>
        <div class="input-append">
            <input type="text" name="nama_pengunjung" id="nama_pengunjung" value="<?php echo array_value($_GET, 'nama_pengunjung')?>"class="required" placeholder="Nama pengunjung" class="span2"><br>    
            <input type="hidden" name="id_pengunjung" id="id_pengunjung" value="<?php echo array_value($_GET, 'id_pengunjung')?>">
            <select name="status" class="span2">
                <?php
                foreach ($pilihanStatus as $key => $status) {
                    $checked=($key==$statusChecked)?'selected':'';
                    echo "<option value='$key' $checked>$status</option>";
                }
                ?>
            </select>
            <select name="isLunas" class="span2">
                <?php
                foreach ($pilihanLunas as $key => $lunas) {
                    $checked=(($key==$isLunasChecked)?'selected':'');
                    echo "<option value='$key' $checked>$lunas</option>";
                }
                ?>
            </select>
            <select name="booked_via" class="span2">
                <?php
                foreach ($pilihanVia as $key => $lunas) {
                    $checked=(($key==$viaChecked)?'selected':'');
                    echo "<option value='$key' $checked>$lunas</option>";
                }
                ?>
            </select>
            <input type="submit" value="Cari" class="btn btn-primary">
        </div>    
    </form>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pengunjung</th>
            <th>Waktu Input</th>
            <th>Jumlah Kamar</th>
            <th width="130px">Jumlah Tagihan</th>
            <th width="130px">Sudah Dibayar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($checkInList as $key => $checkIn) {
            ?>
            <tr class="<?php echo ($checkIn['status'] == 'pending') ? 'warning' : (($checkIn['status'] == 'approved') ? 'success' : 'error') ?>">
                <td><?php echo $no++ ?></td>
                <td><?php echo $checkIn['pengunjung'] ?></td>
                <td><?php echo timeFormatFromMysql($checkIn['waktu']) ?></td>
                <td><?php echo $checkIn['jumlah_kamar'] ?></td>
                <td style="text-align: right;padding-right: 0.5em"><?php echo rupiah($checkIn['jumlah_tagihan'], false) ?></td>
                <td style="text-align: right;padding-right: 0.5em"><?php echo rupiah($checkIn['jumlah_bayar'], false) ?></td>
                <td><?php echo $checkIn['status'] ?></td>
                <td>
                    <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                Action
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                 <a href="<?php echo app_base_url("pageoperator/detail_kunjungan?id=$checkIn[id]") ?>" class="btn btn-primary" target="" title="detail"><i class="icon icon-list"></i></a>   
                                <?php if($checkIn['status']=='pending'):?>
                                    <a href="<?php echo app_base_url("pageoperator/approve?id=$checkIn[id]&status=approved") ?>" class="btn btn-primary" onclick="return window.confirm('Apakah anda yakin?')" title="approve"><i class="icon icon-ok"></i> Approve</a>
                                    <a href="<?php echo app_base_url("pageoperator/approve?id=$checkIn[id]&status=unapproved") ?>" class="btn btn-primary" onclick="return window.confirm('Apakah anda yakin?')" title="hapus"><i class="icon icon-remove"></i></a>
                                <?php endif;?>
                            </ul>
                        </div>
                    
                </td>
            </tr>
            <?php }
        ?>
    </tbody>
</table>
<script type="text/javascript">
$(document).ready(function(){
    $('#nama_pengunjung').autocomplete("<?= app_base_url('autocomplete/pengunjung') ?>",
                {
                    parse: function(data){
                        var parsed = [];
                        for (var i=0; i < data.length; i++) {
                            parsed[i] = {data: data[i],value: data[i].nama};
                        }
                        return parsed;
                    },
                    formatItem: function(data,i,max){
                        $('#id_pengunjung').attr('value','');
                        var str = '<div class="search_content">';
                        str+=data.nama+'<br>'+data.tanda_pengenal+': '+data.no_tanda_pengenal;
                        str += '</div>';
                        return str;
                    },
                    width: 300, // panjang tampilan pencarian autocomplete yang akan muncul di bawah textbox pencarian
                    dataType: 'json' // tipe data yang diterima oleh library ini disetup sebagai JSON
                }).result(
                function(event,data,formated){
                    $(this).attr('value',data.nama);
                    $('#id_pengunjung').attr('value',data.id);
                });
})
</script>