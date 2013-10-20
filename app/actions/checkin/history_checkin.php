<?php
$user=  get_user_login();
$checkInList=  _select_arr("select *,
    (select count(*) from detail_checkin where id_checkin=checkin.id) as jumlah_kamar,
    (select sum(biaya) from detail_checkin where id_checkin=checkin.id) as jumlah_tagihan,
    (select sum(nominal) from pembayaran where id_checkin=checkin.id) as jumlah_bayar
    from checkin where id_pengunjung='$user[id_pengunjung]'
        order by waktu desc");

?>
<h3>History Checkin</h3><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Waktu Input</th>
            <th>Jumlah Kamar</th>
            <th width="130px">Jumlah Tagihan</th>
            <th width="130px">Diskon</th>
            <th width="130px">Sudah Dibayar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no=1;
        foreach ($checkInList as $key => $checkIn) {            
            ?>
        <tr class="<?php echo ($checkIn['status']=='pending')?'warning':(($checkIn['status']=='approved')?'success':'error')?>">
            <td><?php echo $no++?></td>
            <td><?php echo timeFormatFromMysql($checkIn['waktu'])?></td>
            <td><?php echo $checkIn['jumlah_kamar']?></td>
            <td style="text-align: right;padding-right: 0.5em"><?php echo rupiah($checkIn['jumlah_tagihan'],false)?></td>
            <td style="text-align: right;padding-right: 0.5em"><?php echo rupiah($checkIn['jumlah_poin']*$checkIn['nilai_poin'],false)?></td>
            <td style="text-align: right;padding-right: 0.5em"><?php echo rupiah($checkIn['jumlah_bayar'],false)?></td>
            <td><?php echo $checkIn['status']?></td>
            <td>
                <?php 
                if($checkIn['status']=='pending'){
                    if($checkIn['jumlah_poin']==null){
                        ?><a href="<?php echo app_base_url("checkin/pakai_poin?id=$checkIn[id]")?>" target="ajax-modal" title="pakai poin"><i class="icon icon-plus-sign"></i></a> <?php
                    }
                    ?><a href="<?php echo app_base_url("checkin/batalkan?id=$checkIn[id]")?>" onclick="return window.confirm('Apakah anda yakin?')" title="hapus"><i class="icon icon-remove-circle"></i></a> <?php
                    ?><a href="<?php echo app_base_url("checkin/bayar?id=$checkIn[id]")?>" target="ajax-modal" title="bayar"><i class="icon icon-ok-sign" title="bayar"></i></a><?php
                }else{
//                    echo '-';
                }
                ?>
                <a href="<?php echo app_base_url("checkin/detail_checkin?id_checkin=$checkIn[id]")?>" target="ajax-modal"title="detail"><i class="icon icon-list-ol"></i></a>
            </td>
        </tr>
                <?php
        }?>
    </tbody>
</table>
