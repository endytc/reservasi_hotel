<?php
$user=  get_user_login();

$isPesan=isset($_GET['id_checkin']);
if($isPesan){
    $where=" and detail_checkin.id_checkin='$_GET[id_checkin]'";
    $fasilitasList=  _select_arr("select 
        fasilitas_pengunjung.*, fasilitas.nama as fasilitas, kategori_fasilitas.nama as kategori
        from fasilitas_pengunjung
        join fasilitas on id_fasilitas=fasilitas.id
        join kategori_fasilitas on id_kategori=kategori_fasilitas.id
        and fasilitas_pengunjung.id_checkin='$_GET[id_checkin]'
        ");
}else
    $where=" and detail_checkin.id_checkin is null";

$checkInList=  _select_arr("select detail_checkin.*,kamar.nama as kamar,kelas.nama as kelas from detail_checkin 
    join kamar on kamar.id=detail_checkin.id_kamar
    join kelas on kelas.id=kamar.id_kelas
    where id_pengunjung='$user[id]' $where
        ");
?>
<?php if (!$isPesan): ?>
    <div style="text-align: right;width: 100%">
        <a href="<?php echo app_base_url('checkin/pesan_sekarang') ?>" class="btn btn-primary" onclick="return window.confirm('Pesan sekarang?')"><i class="icon icon-shopping-cart"></i> Pesan Sekarang</a>
    </div>
<?php endif; ?>
<br>
<div class="modal-body">
    <table class="table table-bordered ">
        <thead>
            <tr style="text-align: center">
                <th rowspan="2" style="text-align: center;">No</th>
                <th rowspan="2" style="text-align: center;">Kamar</th>
                <th rowspan="2" style="text-align: center;">Kelas</th>
                <th colspan="2" style="text-align: center;">Booking</th>
                <th rowspan="2" style="text-align: center;">Biaya</th>
                <?php if (!$isPesan): ?>
                    <th rowspan="2" style="text-align: center;">Aksi</th>
                <?php endif; ?>
            </tr>
            <tr>
                <th style="text-align: center;">Check in</th>
                <th style="text-align: center;">Check out</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $jumlahTagihan = 0;
            foreach ($checkInList as $checkIn) {
                $jumlahTagihan+=$checkIn['biaya'];
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $checkIn['kamar'] ?></td>
                    <td><?php echo $checkIn['kelas'] ?></td>
                    <td><?php echo $checkIn['masuk'] ?></td>
                    <td><?php echo $checkIn['keluar'] ?></td>
                    <td style="text-align: right;padding-right: 0.5em"><?php echo rupiah($checkIn['biaya'], false) ?></td>
                    <?php if (!$isPesan): ?>
                        <td class="button-column">
                            <a href="<?php echo app_base_url('kamar/batalkan?id=' . $checkIn['id']) ?>"  
                               onclick="return confirm('<?php echo "Apakah anda yakin untuk menghapus detail_checkin $checkIn[masuk]?" ?>')" data-original-title="Batalkan" rel="tooltip">
                                <i class="icon icon-remove-sign"></i>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="success">
                <td colspan="5"><b>Jumlah</b></td>
                <td style="text-align: right;padding-right: 0.5em;"><b><?php echo rupiah($jumlahTagihan, false) ?></b></td>
            </tr>
        </tfoot>
    </table>
    <?php if($isPesan){
        ?>
    <div class="clear"></div><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>Fasilitas</td>
                    <td>Kategori</td>
                    <td>Biaya @</td>
                    <td>Qty</td>
                    <td>Jumlah</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $jumlah = 0;
                foreach ($fasilitasList as $fasilitas) {
                    $jumlah+=($fasilitas['qty'] * $fasilitas['biaya'])
                    ?>
                    <tr>
                        <td><?php echo $fasilitas['fasilitas'] ?></td>
                        <td><?php echo $fasilitas['kategori'] ?></td>
                        <td style="text-align: right;padding-right: 20px"><?php echo rupiah($fasilitas['biaya'], false) ?></td>
                        <td><?php echo $fasilitas['qty'] ?></td>
                        <td style="text-align: right;padding-right: 20px"><?php echo rupiah($fasilitas['qty'] * $fasilitas['biaya'], false) ?></td>
                    </tr>
    <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Jumlah</td>
                    <td style="text-align: right;padding-right: 20px"><?php echo rupiah($jumlah, false) ?></td>
                </tr>
            </tfoot>
        </table>
            <?php
    }
?>
</div>

