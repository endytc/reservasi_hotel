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
?>
<div class="9" style="text-align: right">
    <form>
        <div class="input-append">
            <input type="text" name="nama_pengunjung" id="nama_pengunjung" value="<?php echo array_value($_GET, 'nama_pengunjung')?>"class="required" placeholder="Nama pengunjung" class="span2">    
            <input type="hidden" name="id_pengunjung" id="id_pengunjung" value="<?php echo array_value($_GET, 'id_pengunjung')?>">
            <input type="submit" value="Cari" class="btn btn-primary">
        </div>    
    </form>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pengunjung</th>
            <th>Jumlah Kunjungan</th>
            <th>Jumlah Booking Kamar</th>
            <th>Jumlah Pengeluaran</th>
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
            </tr>
            <?php }?>
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