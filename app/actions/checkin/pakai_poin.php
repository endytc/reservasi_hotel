<?php
$nilaiPoin = _select_unique_result("select*from setting where kd='nilai_poin'");
$jumlahMaxPoin = _select_unique_result("select*from setting where kd='max_poin'");
$user=  get_user_login();
if($_POST){
    
    _query("update pengunjung set jumlah_poin=jumlah_poin-$_POST[pakai_poin] where id='$user[id]'");
    _query("update checkin set jumlah_poin='$_POST[pakai_poin]',nilai_poin='$nilaiPoin[isi]' where id='$_GET[id]'");
    redirect('checkin/history_checkin');
}
?>
<form action="<?php echo app_base_url('checkin/pakai_poin?id='.$_GET['id'])?>" method="POST" class="form-horizontal">
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Gunakan Poin</h3>
</div>
<div class="modal-body">
    <div class="form">
        <fieldset>
            <div class="control-group">
                <label class="control-label required">Pakai Poin</label>                
                <div class="controls">
                    <label class="inline" >
                        <select name="pakai_poin" class="required">
                            <option value="">Pilih</option>
                            <?php
                            $i = 1; 
                            while($i <= $jumlahMaxPoin['isi'] && $i<=$user['jumlah_poin']) {
                                echo "<option value='$i'>$i (" . rupiah($i * $nilaiPoin['isi']) . ")</option>";
                                $i++;
                            }
                            ?>
                        </select>
                    </label>
                </div>    
            </div>    
        </fieldset>
    </div>
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit" >Tambah</button>            
    <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
</div>
</form>