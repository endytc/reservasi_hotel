<?php
$bank=  _select_unique_result("select * from bank where id=$_GET[id]");

?>
<form action="<?php echo app_base_url('pageadmin/bank/edit').'?id='.$_GET['id']?>" method="POST" id="addbank" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Edit Bank </h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
        <div class="control-group">
                    <label class="control-label required">Nama Bank</label>                
                    <div class="controls">
                        <?php echo $bank['nama_bank']?>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Atas Nama</label>                
                    <div class="controls">
                        <?php echo $bank['atas_nama']?>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">No Rekening</label>                
                    <div class="controls">
                        <?php echo $bank['no_rekening']?>
                    </div>    
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php
                        if ($bank['gambar'] != '') {
                            ?><a class="bank-fancybox" href="<?php echo app_base_url() . '/' . $bank['gambar']; ?>"><img src="<?php echo app_base_url() . '/' . $bank['gambar']; ?>" width="70"></a><?php
                        } else {
                            ?><img src="<?php echo app_base_url() . '/upload/not-found.png'; ?>" width="40"><?php
                        }
                        ?>
                        
                    </div>    
                </div>
            </fieldset>
        </div><!-- form -->
</div>
<div class="modal-footer">
    <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
</div>    
</form>