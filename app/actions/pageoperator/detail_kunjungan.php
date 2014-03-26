<?php
if(isset($_GET['act']) && $_GET['act']=='delete'){
    $qry=  _query("delete from pembayaran where id='$_GET[id_bayar]'");
    if($qry){
        $_SESSION['success']="Pembayaran berhasil dihapus";
    }else
        $_SESSION['failed']="Pembayaran gagal dihapus";
    redirect('pageoperator/detail_kunjungan?id='.$_GET['id']);
}
if(isset($_GET['act']) && $_GET['act']=='batalkan_poin'){
    $qry=  _query("update checkin set jumlah_poin=NULL where id='$_GET[id]'");
    if($qry){
        $_SESSION['success']="Pemakaian poin berhasil dihapus";
    }else
        $_SESSION['failed']="Pemakaian poin gagal dihapus";
    redirect('pageoperator/detail_kunjungan?id='.$_GET['id']);
}
if(isset($_GET['act']) && $_GET['act']=='delete_fasilitas'){
    $qry=  _query("delete from fasilitas_pengunjung where id='$_GET[id_fasilitas]'");
    if($qry){
        $_SESSION['success']="Fasilitas pengunjung berhasil dihapus";
    }else
        $_SESSION['failed']="Fasilitas pengunjung gagal dihapus";
    redirect('pageoperator/detail_kunjungan?id='.$_GET['id']);
}
$detail=  _select_unique_result("
    select checkin.*,pengunjung.nama as pengunjung,pengunjung.no_hp,
    ((select sum(biaya) from detail_checkin where detail_checkin.id_checkin=checkin.id)+
    IFNULL((select sum(biaya*qty) from fasilitas_pengunjung where fasilitas_pengunjung.id_checkin=checkin.id),0))as jumlah_tagihan
from checkin 
    join pengunjung on id_pengunjung=pengunjung.id
    where checkin.id='$_GET[id]'
");

$detailCheckinList=  _select_arr("select detail_checkin.*,kamar.nama as kamar from detail_checkin 
    join kamar on kamar.id=id_kamar
    where id_checkin='$_GET[id]'");
$pembayaranList=  _select_arr("select pembayaran.*,ifnull(bank.nama_bank,'-') as bank from pembayaran 
    left join bank on bank.id=id_bank
    where pembayaran.id_checkin='$_GET[id]'");
$fasilitasList=  _select_arr("select 
    fasilitas_pengunjung.*, fasilitas.nama as fasilitas, kategori_fasilitas.nama as kategori
    from fasilitas_pengunjung
    join fasilitas on id_fasilitas=fasilitas.id
    join kategori_fasilitas on id_kategori=kategori_fasilitas.id
    where id_checkin='$_GET[id]'
    ");
?>

<div class="modal-header">
    <h3>Detail Checkin [<div id="status-tagihan" style="display: inline;font-weight: bold;color: #f30404"></div>]</h3>
    </div>
<div class="row-fluid">
    <div class="span5">
        <table class="table">
            <tr>
                <td width="120px">Pengunjung</td><td><?php echo $detail['pengunjung']?></td>
            </tr>
            <tr>
                <td>No Hp</td><td><?php echo $detail['no_hp']?></td>
            </tr>
            <tr>
                <td>Booked Via</td><td><?php echo $detail['booked_via']?></td>
            </tr>
            <tr>
                <td>Status</td><td><?php echo $detail['status']?></td>
            </tr>
            <tr>
                <td>Jumlah Tagihan</td><td><?php echo rupiah($detail['jumlah_tagihan'])?></td>
            </tr>
        </table>
    </div>
    <div class="span7">
        <?php if($_SESSION['status_user']=='operator'){?>
        <a href="<?php echo app_base_url("pageoperator/ambil_kunci?id=$_GET[id]&status=approved") ?>" class="btn btn-primary" onclick="return window.confirm('Apakah anda yakin?')" title="Ambil semua kunci"><i class="icon icon-key"></i> Ambil</a>
        <a href="<?php echo app_base_url("pageoperator/kembali_kunci?id=$_GET[id]&status=approved") ?>" class="btn btn-primary" onclick="return window.confirm('Apakah anda yakin?')" title="Mengembalikan semua kunci"><i class="icon icon-key"></i> Kembali</a>
        <?php }?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>Kamar</td>
                    <td>Checkin</td>
                    <td>Jumlah Biaya</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($detailCheckinList as $bayar){?>
                <tr>
                    <td style="vertical-align: top"><?php echo $bayar['kamar']?></td>
                    <td>
                        <?php echo $bayar['masuk'].' s.d '.$bayar['keluar']?><br>
                        <?php echo "Pengambilan Kunci: ".
                            (($bayar['waktu_mengambil_kunci']==null)?
                                "<a href='".app_base_url("pageoperator/ambil_kunci?id=$_GET[id]&id_detail=".$bayar['id'])."'>Sekarang</a>":
                                $bayar['waktu_mengambil_kunci'])
                        ?><br>
                        <?php echo "Pengembalian Kunci: ".
                            (($bayar['waktu_mengembalikan_kunci']==null)?
                                "<a href='".app_base_url("pageoperator/kembali_kunci?id=$_GET[id]&id_detail=".$bayar['id'])."'>Sekarang</a>":
                                $bayar['waktu_mengembalikan_kunci'])
                        ?>
                    </td>
                    <td style="text-align: right;padding-right: 10px">
                        <?php echo rupiah($bayar['biaya'],false)?>
                        <a href="<?php echo app_base_url('pageoperator/tambah_jam')."?id_check_in_list=".$bayar['id']."&id=$_GET[id]"?>" target="ajax-modal" title="Tambah Jam"><i class="icon icon-plus-sign"></i></a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<div class="clear"></div><br>
<?php if($_SESSION['status_user']=='operator'){?>
<a href="<?php echo app_base_url("pageoperator/bayar?id=$_GET[id]") ?>" class="btn btn-primary" target="ajax-modal" title="bayar">Bayar</a>
<?php }
if($detail['jumlah_poin']==null){
    ?><a href="<?php echo app_base_url("checkin/pakai_poin?id=$detail[id]&operator=1")?>" target="ajax-modal" title="pakai poin" class="btn btn-primary">Pakai Poin</a> <?php
}
?>
<div class="clear"></div><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>Bank</td>
            <td>Nominal</td>
            <td>Bukti Pembayaran</td>
            <td>Keterangan</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $jumlahBayar=0;
        if($detail['jumlah_poin']<>null){
            $jumlahBayar+=$detail['jumlah_poin']*$detail['nilai_poin'];
            ?>
            <td>Pakai Poin</td>
            <td><?php echo rupiah($detail['jumlah_poin']*$detail['nilai_poin'],false)?></td>
            <td>-</td>
            <td>-</td>
            <td>
                <a href="<?php echo app_base_url("pageoperator/detail_kunjungan?act=batalkan_poin&id=$_GET[id]")?>" onclick="return window.confirm('apakah anda yakin?')">
                    <i class="icon icon-remove-circle"></i>
                </a>
            </td>
            <?
        }

        foreach($pembayaranList as $bayar){
            $jumlahBayar+=$bayar['nominal']?>
        <tr>
            <td><?php echo $bayar['bank']?></td>
            <td><?php echo rupiah($bayar['nominal'],false)?></td>
            <td>
                <?php if(file_exists($bayar['gambar'])){?>
                <img src="<?php echo app_base_url().'/'.$bayar['gambar']?>" width="20px">
                <?php }else echo '-'?>
            </td>
            <td><?php echo $bayar['keterangan']?></td>
            <td><a href="<?php echo app_base_url("pageoperator/detail_kunjungan?act=delete&id_bayar=$bayar[id]&id=$_GET[id]")?>" onclick="return window.confirm('apakah anda yakin?')"><i class="icon icon-remove-circle"></i></a></td>
        </tr>
        <?php }?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
                Jumlah Pembayaran: <?php echo rupiah($jumlahBayar,false);?>
            </td>
        </tr>
    </tfoot>
</table>
<div class="clear"></div><br>
<?php if($_SESSION['status_user']=='operator'){?>
<a href="<?php echo app_base_url("pageoperator/add_fasilitas?id=$_GET[id]") ?>" class="btn btn-primary" target="ajax-modal" title=""><i class="icon icon-plus-sign"></i> Tambah Fasilitas</a>
<?php }?>
<div class="clear"></div><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>Fasilitas</td>
            <td>Kategori</td>
            <td>Biaya @</td>
            <td>Qty</td>
            <td>Jumlah</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        $jumlah=0;
        foreach($fasilitasList as $fasilitas){
            $jumlah+=($fasilitas['qty']*$fasilitas['biaya'])?>
        <tr>
            <td><?php echo $fasilitas['fasilitas']?></td>
            <td><?php echo $fasilitas['kategori']?></td>
            <td style="text-align: right;padding-right: 20px"><?php echo rupiah($fasilitas['biaya'],false)?></td>
            <td><?php echo $fasilitas['qty']?></td>
            <td style="text-align: right;padding-right: 20px"><?php echo rupiah($fasilitas['qty']*$fasilitas['biaya'],false)?></td>
            <td><a href="<?php echo app_base_url("pageoperator/detail_kunjungan?act=delete_fasilitas&id_fasilitas=$fasilitas[id]&id=$_GET[id]")?>" onclick="return window.confirm('apakah anda yakin?')"><i class="icon icon-remove-circle"></i></a></td>
        </tr>
        <?php }?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">Jumlah</td>
            <td style="text-align: right;padding-right: 20px"><?php echo rupiah($jumlah,false)?></td>
            <td>&nbsp;</td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
$(document).ready(function(){
    $('#status-tagihan').html("<?php echo $detail['jumlah_tagihan']<=$jumlahBayar?'Lunas':'Belum Lunas'?>");
})
</script>