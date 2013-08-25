<?php
$user=  get_user_login();
$where=" and detail_checkin.id_checkin is null";
$checkInList=  _select_arr("select detail_checkin.*,kamar.nama as kamar,
        kelas.nama as kelas,kelas.gambar,kamar.keterangan 
    from detail_checkin
    join kamar on kamar.id=detail_checkin.id_kamar
    join kelas on kelas.id=kamar.id_kelas
    where id_pengunjung='$user[id]' $where
        ");

?>
<div class="btn-group">
    <a class="btn <?php echo (count($checkInList)>0)?'dropdown-toggle':''?>" data-toggle="dropdown" href="<?php echo app_base_url() ?>/assets/#">
        <i class="icon-shopping-cart"></i> <?php echo count($checkInList)?> Items
        <?php if(count($checkInList)>0):?><span class="caret"></span><?php endif;?>
    </a>
    <?php if(count($checkInList)>0):?>
    <div class="dropdown-menu cart-content pull-right">
        <table class="table-cart">
            <tbody>
                <?php 
                $total=0;
                foreach($checkInList as $checkIn){
                    $total+=$checkIn['biaya'];
                    ?>
                    <tr>
                        <td class="cart-product-info">
                            <a href=""><img src="<?php echo app_base_url($checkIn['gambar'  ])?>" class="img-rounded"style="width: 50;height: 50px"alt="product image"></a>
                            <div class="cart-product-desc">
                                <p><?php echo $checkIn['kelas']?></p>
                                <ul class="unstyled">
                                    No Kamar: <?php echo $checkIn['kamar']?>
                                    <br>
                                    <?php echo $checkIn['keterangan']?>
                                </ul>
                            </div>
                        </td>
                        <td class="cart-product-setting">
                            <p><strong><?php echo rupiah($checkIn['biaya'],false)?></strong></p>
                        </td>
                    </tr>
                    <?php
                }
?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="cart-product-info">
                        <a href="<?php echo app_base_url('checkin/detail_checkin') ?>" class="btn btn-small">Vew cart</a>
                    </td>
                    <td>
                        <h3>TOTAL&nbsp;&nbsp;&nbsp;<?php echo rupiah($total,false)?></h3>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif;?>
</div>