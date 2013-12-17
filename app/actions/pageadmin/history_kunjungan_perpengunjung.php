<?php 
$where="1=1";
if(array_value($_GET, 'nama_pengunjung')!=''){
    $where.=" and pengunjung.nama like'%".  array_value($_GET, 'nama_pengunjung')."%'";
}

$sortBy = isset ($_GET['sortBy'])?$_GET['sortBy']:NULL;
$sort = isset ($_GET['sort'])?$_GET['sort']:NULL;
if ($sort != NULL) {
$order = "order by id $sortBy";
}else $order = "";

$pengunjungList=  _select_arr("select *,
            (select sum(detail_checkin.biaya) from detail_checkin 
            join checkin on checkin.id=detail_checkin.id_checkin
            where checkin.status='approved' and checkin.id_pengunjung=pengunjung.id
            ) as total_biaya,
            (select count(*) from detail_checkin 
            join checkin on checkin.id=detail_checkin.id_checkin
            where checkin.status='approved' and checkin.id_pengunjung=pengunjung.id
            ) as jumlah_booking_kamar,
            (select count(*) from  checkin 
            where checkin.status='approved' and checkin.id_pengunjung=pengunjung.id
            ) as jumlah_kunjungan,
            pengunjung.id as id,pengunjung.nama as pengunjung
             from pengunjung
            join member on member.id_pengunjung=pengunjung.id where $where 
        having total_biaya>0
        $order
            "
        );
$pagging= pagination("select *  from pengunjung
            join member on member.id_pengunjung=pengunjung.id where $where", getPerPage());
?>
<div class="9" style="text-align: right">
    <form>
        <div class="input-append">
            <input type="text" name="nama_pengunjung" id="nama_pengunjung" value="<?php echo array_value($_GET, 'nama_pengunjung')?>"class="required" placeholder="Nama pengunjung" class="span2">
            <input type="submit" value="Cari" class="btn btn-primary">
        </div>    
    </form>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th><a href="<?= app_base_url('pageadmin/history_kunjungan_perpengunjung?').generate_sort_parameter('pengunjung', $sortBy)?>" class="sorting">Pengunjung</a></th>
            <th><a href="<?= app_base_url('pageadmin/history_kunjungan_perpengunjung?').generate_sort_parameter('total_biaya', $sortBy)?>" class="sorting">Jumlah Pembayaran</a></th>
            <th><a href="<?= app_base_url('pageadmin/history_kunjungan_perpengunjung?').generate_sort_parameter('jumlah_kunjungan', $sortBy)?>" class="sorting">Jumlah Kunjungan</a></th>
            <th><a href="<?= app_base_url('pageadmin/history_kunjungan_perpengunjung?').generate_sort_parameter('jumlah_booking_kamar', $sortBy)?>" class="sorting">Jumlah Booking Kamar</a></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($pengunjungList as $key => $pengunjung) {
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $pengunjung['pengunjung'] ?></td>
                <td><?php echo $pengunjung['total_biaya'] ?></td>
                <td><?php echo $pengunjung['jumlah_kunjungan'] ?></td>
                <td><?php echo $pengunjung['jumlah_booking_kamar'] ?></td>
            </tr>
            <?php }
        ?>
    </tbody>
</table>
<?php $pagging?>
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