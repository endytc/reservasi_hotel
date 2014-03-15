<?php
if(!isset($_GET['status'])){
    $_GET['status']='approved';
}
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

$checkInList = _select_arr("select pengunjung.nama as pengunjung,
  detail_checkin.*,checkin.*, kamar.nama as kamar from detail_checkin
  join checkin on checkin.id=detail_checkin.id_checkin
  join kamar on kamar.id=id_kamar
  join pengunjung on pengunjung.id=checkin.id_pengunjung
    where $where
    having $having
    order by checkin.waktu desc
    ");
$pilihanStatus = array('' => '- Semua -','pending' => 'Pending',
    'approved' => 'Approve'
);
$pilihanVia=array(''=>'- Semua -','online'=>'Online','offline'=>'Offline');
?>
<div class="span2" style="text-align: left">
    <?php if($_SESSION['status_user']=='operator'){?>
        <a href="<?php echo app_base_url('pageoperator/kunjungan')?>" class="btn btn-primary">
            <i class="icon icon-plus-sign"></i> Tambah
        </a>
    <?php }?>
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
        <th rowspan="2">No</th>
        <th rowspan="2">Pengunjung</th>
        <th  rowspan="2">Waktu Input</th>
        <th colspan="2">Status Kunci</th>
        <th rowspan="2">Status</th>
        <?php if($_SESSION['status_user']=='operator'){?>
            <th rowspan="2">Aksi</th>
        <?php }?>
    </tr>
    <tr>
        <th>Diambil</th>
        <th>Dikembalikan</th>
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
            <td><?php echo $checkIn['waktu_mengambil_kunci'] ?></td>
            <td><?php echo $checkIn['waktu_mengembalikan_kunci'] ?></td>
            <td><?php echo $checkIn['status'] ?></td>
            <?php if($_SESSION['status_user']=='operator'){?>
                <td>
                    <div class="btn-group">
                            <a href="<?php echo app_base_url("pageoperator/detail_kunjungan?id=$checkIn[id]") ?>" class="btn btn-primary" target="" title="detail"><i class="icon icon-list"></i></a>
                    </div>

                </td>
            <?php }?>
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