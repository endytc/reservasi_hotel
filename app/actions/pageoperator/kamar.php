<?php
$isIdKelasParam = false;
if (isset($_GET['tanggal_check_in'])) {
    $where = '1=1';
    if (isset($_GET['id_kelas']) && $_GET['id_kelas'] != '') {
        $isIdKelasParam = true;
        $where.=" and id_kelas=$_GET[id_kelas]";
    }
    $kamarList = _select_arr("select kamar.*,kelas.nama as kelas from kamar 
        join kelas on kelas.id=kamar.id_kelas
        where kamar.id not in
            (
                select id_kamar from 
                    detail_checkin c 
                join checkin on checkin.id=c.id_checkin    
                where 
                    ((c.masuk>'$_GET[tanggal_check_in] $_GET[jam_check_in]' AND c.masuk<'$_GET[tanggal_check_out] $_GET[jam_check_out]') OR
                    (c.keluar>'$_GET[tanggal_check_in] $_GET[jam_check_in]' AND c.keluar<'$_GET[tanggal_check_out] $_GET[jam_check_out]')) AND
                    checkin.status<>'unapproved'
            )
            and $where
                order by id_kelas
    ");
}
$kelasList = _select_arr("select * from kelas");
?>
<div class="modal-header">
    <h3>Hasil Pencarian</h3>
</div>
<?php
if (isset($kamarList)) {
    ?>
    <div style="background-color: #ececec" class="span12">

        <form action="<?php echo app_base_url('pageoperator/booking?') . generate_get_parameter($_GET) ?>" method="POST">
            <div class="span3" >
                Pilihan Kamar    
                <select multiple="multiple" name="kamar_list[]">
                    <?php
                    $id_kelas = '';
                    $isGroupShow = false;
                    foreach ($kamarList as $kamarData) {
                        if ($id_kelas != $kamarData['id_kelas'] && !$isIdKelasParam) {
                            if ($isGroupShow)
                                echo "</optgroup>";
                            $id_kelas = $kamarData['id_kelas'];
                            echo "<optgroup label='$kamarData[kelas]'>";
                            $isGroupShow = true;
                        }
                        echo "<option value='$kamarData[id]'>$kamarData[nama]</option>";
                    }
                    if ($isGroupShow) {
                        echo "</optgroup>";
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
    ?><div class="alert alert-info">Lakukan pencarian terlebih dahulu!</div><?php
}
?>
<div class="clear"></div>
<form action="<?php echo app_base_url('pageoperator/kamar') ?>" method="GET" id="carikamar" class="form-horizontal">
    <div class="modal-header">
        <h3>Pencarian Kamar</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Kelas</label>                
                    <div class="controls">
                        <select name="id_kelas">
                            <option value="">Semua Kelas</option>
                            <?php foreach ($kelasList as $kelas) {
                                ?><option value="<?php echo $kelas['id'] ?>"><? echo $kelas['nama'] . ' (' . rupiah($kelas['biaya_per_hari']) . '/24 jam)' ?></option><?php
                            }
                            ?>
                        </select>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Check In</label>                
                    <div class="controls">
                        <input type="text" class="required tanggal_pesan span2 tanggal" name="tanggal_check_in" placeholder="dd/mm/yyyy" value="<?php echo array_value($_GET, 'tanggal_check_in') ?>">
                        <input type="text" class="required span2" name="jam_check_in" placeholder="00:00:00"value="<?php echo array_value($_GET, 'jam_check_in') ?>">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Check Out</label>                
                    <div class="controls">
                        <input type="text" class="required span2 tanggal_pesan tanggal" name="tanggal_check_out" placeholder="dd/mm/yyyy" value="<?php echo array_value($_GET, 'tanggal_check_out') ?>">
                        <input type="text" class="required span2" name="jam_check_out" placeholder="00:00:00" value="<?php echo array_value($_GET, 'jam_check_out') ?>">
                    </div>    
                </div>
            </fieldset>
        </div><!-- form -->
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="submit" ><i class="icon icon-search"></i> Cari</button>            
    </div>    
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#addadmin').validate();
        $('#carikamar').validate();
        $('#carikamar').formatTanggal();
        $('#addadmin').formatTanggal();
        $('.tanggal_pesan').datepicker();
    });
</script>