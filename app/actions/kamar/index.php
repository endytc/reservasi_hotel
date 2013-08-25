<?php
$kelasQry=  _select_arr("select *,(select count(*) from kamar where kamar.id_kelas=kelas.id) as jumlah_kamar from kelas");
include 'app/actions/kamar/top.php';
?>
<div id="featuredItems">
    <div class="titleHeader clearfix">
        <h3>Kamar</h3>
    </div><!--end titleHeader-->

    <div class="row">
        <ul class="hProductItems clearfix">
            <?php foreach($kelasQry as $kelas):?>
            <li class="span3 clearfix">
                <div class="thumbnail">
                    <a href="#"><img src="<?php echo app_base_url().'/'.$kelas['gambar']?>" style="height: 200px" alt=""></a>
                </div>
                <div class="thumbSetting">
                    <div class="thumbTitle">
                        <a href="#" class="invarseColor">
                            <?echo $kelas['nama']?>
                        </a>
                    </div>
                    <div class="thumbPrice">
                        <span><?php echo rupiah($kelas['biaya_per_hari'])?>/24 jam</span>
                    </div>

                    <div class="thumbButtons">
                        <a href="<?php echo app_base_url().'/kamar/cek_kamar?id_kelas='.$kelas['id']?>"class="btn btn-primary btn-small" data-title="+Pesan Kamar" data-placement="top" rel="tooltip">
                            <i class="icon-shopping-cart"></i>
                        </a>
                        <a href="<?php echo app_base_url().'/kamar/add_star?id_kelas='.$kelas['id']?>" class="btn btn-small" data-title="+To WishList" data-placement="top" rel="tooltip">
                            <i class="icon-heart"></i>
                        </a>
                    </div>  
                    <ul class="rating">
                        <?php
                        $i=0;
                        while($i<$kelas['star'] && $i<5){
                            ?><li><i class="star-on"></i></li><?php
                            $i++;
                        }
                        while($i<5){
                            ?><li><i class="star-off"></i></li><?php
                            $i++;
                        }
                        ?>
                    </ul>
                </div>
            </li>
            <?php endforeach;?>
        </ul>
    </div><!--end row-->
</div>