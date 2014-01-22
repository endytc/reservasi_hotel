
<?php
$penerimaList=_select_arr("select * from promo_pengunjung 
    join pengunjung on pengunjung.id=promo_pengunjung.id_pengunjung
    join member on member.id_pengunjung=pengunjung.id
    where id_promo='$_GET[id]'
    ");
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Penerima Promo</h3>
</div>
<div class="modal-body">
    <div class="form">    
        <fieldset>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($penerimaList as $penerima):?>
                    <tr>
                        <td><?php echo $penerima['nama']?></td>
                        <td><?php echo $penerima['email']?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </fieldset>
    </div>
</div>
<div class="modal-footer">
    <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
</div>