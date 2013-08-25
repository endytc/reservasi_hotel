<?php
if(isset($_GET['act']) && $_GET['act']=='hapus_detail'){
    _query("delete from detail_checkin where id='$_GET[id]'");
}
if(isset($_GET['act']) && $_GET['act']=='save_kunjungan'){
    _insert('checkin', array(
        'id_pengunjung'=>$_POST['checkin']['id_pengunjung'],
        'status'=>'approved',
        'booked_via'=>'offline'
    ));
    $idCheckin=_select_unique_result("select max(id) as id from checkin where id_pengunjung='".$_POST['checkin']['id_pengunjung']."'");
    _update('detail_checkin', array('id_checkin'=>$idCheckin['id']), "id_checkin is NULL");
    redirect('pageoperator/pembayaran?id='.$idCheckin['id']);
    
}
$checkInDetail=  _select_arr("select detail_checkin.*,kelas.nama as kelas,kamar.nama as kamar from detail_checkin 
    join kamar on kamar.id=detail_checkin.id_kamar
    join kelas on kelas.id=kamar.id_kelas
    where id_checkin is NULL");
?>
<h3>Tambah Kunjungan</h3>
<hr>
<form action="<?php echo app_base_url('pageoperator/kunjungan?act=save_kunjungan')?>"method="POST"class="form-horizontal" id="kunjungan-form">
    <div class="modal-body">
        <div class="form">
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Pengunjung</label>                
                    <div class="controls">
                        <input type="text" name="" id="nama_pengunjung" class="required">    
                        <input type="hidden" name="checkin[id_pengunjung]" id="id_pengunjung">    
                        <a href="<?php echo app_base_url('pageoperator/pengunjung/add') ?>" class="btn btn-primary" target="_blank">
                            <i class="icon icon-plus-sign"></i> Pengunjung
                        </a>
                    </div>    
                </div> 
            </fieldset>
        </div>
        <h4>Detail</h4>
        <hr>
        <a class="btn btn-primary" href="<?php echo app_base_url('pageoperator/kamar')?>"><i class="icon icon-plus-sign"></i> Tambah</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kelas</th>
                    <th>No Kamar</th>
                    <th>Checkin</th>
                    <th>Checkout</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $jumlah=0;
                foreach ($checkInDetail as $key => $checkIn) {
                    $jumlah+=$checkIn['biaya'];
                    ?>
                    <tr>
                        <td><?php echo $checkIn['kelas'] ?></td>
                        <td><?php echo $checkIn['kamar'] ?></td>
                        <td><?php echo $checkIn['masuk'] ?></td>
                        <td><?php echo $checkIn['keluar'] ?></td>
                        <td style="text-align: right"><?php echo rupiah($checkIn['biaya'],false) ?></td>
                        <td>
                            <a href="<?php echo app_base_url('pageoperator/kunjungan?act=hapus_detail&id='.$checkIn['id'])?>"
                               onclick="return window.confirm('Apakah anda yakin?')">
                                <i class="icon icon-remove-circle"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right"><?php echo rupiah($jumlah,false)?></td>
                    <td>&nbsp;</td>
                </tr>
                
            </tfoot>
        </table>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>
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
                $('#kunjungan-form').validate();
})
</script>