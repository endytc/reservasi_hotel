<?php
if($_POST){
    $fasilitas= _select_unique_result("select * from fasilitas where id='".$_POST['fasilitas']['id_fasilitas']."'");
    $_POST['fasilitas']['biaya']=$fasilitas['harga'];
    $is_success         = _insert('fasilitas_pengunjung', $_POST['fasilitas']);
    if($is_success){
        $_SESSION['success']="Penggunaan fasilitas berhasil ditambahkan";
    }else{  
        $_SESSION['failed']="Penggunaan fasilitas gagal ditambahkan";
    }
    redirect('pageoperator/detail_kunjungan?id='.$_POST['fasilitas']['id_checkin']);
}

?>
<form action="<?php echo app_base_url('pageoperator/add_fasilitas')?>" method="POST" id="addfasilitas" class="form-horizontal"  enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Bayar</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <input type="hidden" name="fasilitas[id_checkin]" value="<?php echo $_GET['id']?>">
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Fasilitas</label>                
                    <div class="controls">
                        <input type="text" name="nama" id="fasilitas">
                        <div  id="fasilitas-img"></div>
                        <input type="hidden" name="fasilitas[id_fasilitas]" class="required" id="id-fasilitas">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Biaya @</label>                
                    <div class="controls">
                        <label class="inline" id="biaya-label"></label>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Qty</label>                
                    <div class="controls">
                        <input type="text" class="required number" value="" name="fasilitas[qty]">
                    </div>    
                </div>
            </fieldset>
        </div><!-- form -->
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit" >Tambah</button>            
    <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
</div>    
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#addfasilitas').validate({
            message:{
                'fasilitas[id_fasilitas]':'fasilitas tidak ditemukan'
            }
        });
        $('#fasilitas').autocomplete("<?= app_base_url('autocomplete/fasilitas') ?>",
        {
            parse: function(data){
                var parsed = [];
                for (var i=0; i < data.length; i++) {
                    parsed[i] = {data: data[i],value: data[i].nama};
                }
                return parsed;
            },
            formatItem: function(data,i,max){
                $('#id-fasilitas').attr('value','');
                var str = '<div class="search_content">';
                str+=data.nama+'<br><b>biaya</b> :'+data.harga;
                str += '</div>';
                return str;
            },
            width: 300, // panjang tampilan pencarian autocomplete yang akan muncul di bawah textbox pencarian
            dataType: 'json' // tipe data yang diterima oleh library ini disetup sebagai JSON
        }).result(
        function(event,data,formated){
            $(this).attr('value',data.nama);
            $('#id-fasilitas').attr('value',data.id);
            $('#biaya-label').html(data.harga);
            $('#fasilitas-img').html("<br><img src='<?php echo app_base_url()?>/"+data.gambar+"' width='100px'>");
        });
    });
</script>