<?php
if (isset($_GET['tanggal_check_in'])) {
    $kamarList = _select_arr("select * from kamar where kamar.id not in
            (
                select id_kamar from 
                    detail_checkin c 
                join checkin on checkin.id=c.id_checkin    
                where 
                    ((c.masuk>'$_GET[tanggal_check_in] $_GET[jam_check_in]' AND c.masuk<'$_GET[tanggal_check_out] $_GET[jam_check_out]') OR
                    (c.keluar>'$_GET[tanggal_check_in] $_GET[jam_check_in]' AND c.keluar<'$_GET[tanggal_check_out] $_GET[jam_check_out]')) AND
                    checkin.status<>'unapproved'
            )
            and id_kelas=$_GET[id_kelas]
    ");
}$kelas = _select_unique_result("select * from kelas where id=$_GET[id_kelas]");
?>
<div class="modal-header">
    <h3>Hasil Pencarian</h3>
</div>
<?php
if (isset($kamarList)) {
    ?>
    <div style="background-color: #ececec" class="span12">
            <form action="<?php echo app_base_url('kamar/booking?') . generate_get_parameter($_GET) ?>" method="POST">
                <div class="span3" >
                    Pilihan Kamar    
                    <select multiple="multiple" name="kamar_list[]">
                        <?php
                        foreach ($kamarList as $kamarData) {
                            echo "<option value='$kamarData[id]'>$kamarData[nama]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="span3">
                    &nbsp;<br>
                    <input type="submit" value="Booking >>" class="btn btn-primary">
                </div>
            </form>
        </div>    
    <?php
} else {
    ?><div class="alert alert-info">Pilih kamar dan jadwal terlebih dahulu!</div><?php
}
?>
<div class="clear"></div>
<form action="<?php echo app_base_url('kamar/cek_kamar?id_kelas=' . $_GET['id_kelas']) ?>" method="GET" id="addadmin" class="form-horizontal">
    <div class="modal-header">
        <h3>Booking Kamar</h3>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id_kelas" value="<?php echo $_GET['id_kelas'] ?>">
        <div class="form">    
            <div class="span12" style="">
                <div class="span6">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label required">Kelas</label>                
                            <div class="controls">
                                <label><? echo $kelas['nama'] ?></label>
                            </div>    
                        </div>
                        <div class="control-group">
                            <label class="control-label required">Biaya</label>                
                            <div class="controls">
                                <label><? echo rupiah($kelas['biaya_per_hari']) ?> /24 jam</label>
                            </div>    
                        </div>
                        <div class="control-group">
                            <label class="control-label required">Check In</label>                
                            <div class="controls">
                                <input type="text" class="required tanggal_pesan span2 tanggal" name="tanggal_check_in" placeholder="dd/mm/yyyy" value="<?php echo array_value($_GET, 'tanggal_check_in') ?>">
                                <input type="text" class="required span2" name="jam_check_in" placeholder="24:00"value="<?php echo array_value($_GET, 'jam_check_in') ?>">
                            </div>    
                        </div>
                        <div class="control-group">
                            <label class="control-label required">Check Out</label>                
                            <div class="controls">
                                <input type="text" class="required span2 tanggal_pesan tanggal" name="tanggal_check_out" placeholder="dd/mm/yyyy" value="<?php echo array_value($_GET, 'tanggal_check_out') ?>">
                                <input type="text" class="required span2" name="jam_check_out" placeholder="24:00" value="<?php echo array_value($_GET, 'jam_check_out') ?>">
                            </div>    
                        </div>
                    </fieldset>
                </div>
                <div class="span4">
                    <img src="<?php echo app_base_url() . '/' . $kelas['gambar'] ?>" style="height: 200px" alt="" class="img-polaroid"/>
                </div>
            </div>
        </div><!-- form -->
    </div>
    <div class="">
        <button class="btn btn-primary" type="submit" ><i class="icon icon-search"></i> Cari</button>            
    </div>    
</form>
<div class="alert alert-block"><b>Ketentuan<hr></b>
<ul>
    <li>Biaya dihitung per 24 jam</li>
    <li>Jika kelebihan dari kelipatan 24 jam
        <ul>
            <li>Kurang dari 6 jam dihitung dari 50% dari harga kamar</li>
            <li>Lebih dari 6 jam dihitung sesuai dengan harga kamar (full rate)</li>
        </ul>
    </li>
</ul>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#addadmin').validate();
        $('#addadmin').formatTanggal();
        $('.tanggal_pesan').datepicker();
    });
</script>