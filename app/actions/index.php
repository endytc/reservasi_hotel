<?php
$user=get_user_login();
$kelasQry=  _select_arr("select *,(select count(*) from kamar where kamar.id_kelas=kelas.id) as jumlah_kamar
from kelas
  order by (select count(*) from detail_checkin
    join checkin on checkin.id=detail_checkin.id_checkin
  where checkin.id_pengunjung='$user[id]' and detail_checkin.id_checkin=checkin.id
  ) desc,(select count(*) from detail_checkin
    join checkin on checkin.id=detail_checkin.id_checkin
  where detail_checkin.id_checkin=checkin.id
  ) desc
  limit 3
    ");
$artikelList =  _select_arr("select *,artikel.id as id_artikel,date(waktu_post) as tanggal, 
    time(waktu_post) as jam  
    from artikel 
        order by waktu_post desc
        limit 0,3 
        
        ");

include 'app/actions/kamar/top.php';

?>
<div class="row">
    <div class="titleHeader clearfix">
        <h3>Kamar</h3>
    </div><!--end titleHeader-->
    <ul class="hProductItems clearfix">
        <?php foreach($kelasQry as $kelas):?>
            <li class="span4 clearfix">
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
                        <?php if(is_login()): ?>
                            <a href="<?php echo app_base_url().'/kamar/add_star?id_kelas='.$kelas['id']?>" class="btn btn-small" data-title="+Rate" data-placement="top" rel="tooltip">
                                <i class="icon-heart"></i>
                            </a>
                        <?php endif;?>
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
<div id="featuredItems">
    <div class="titleHeader clearfix">
        <h3>Artikel</h3>
    </div><!--end titleHeader-->
    <div class="row-fluid">
        <?php foreach($artikelList as $artikel):?>
        <div class="span4">
            <h2><?php echo $artikel['judul'];?></h2>
            <img src="<?php echo app_base_url($artikel['path_gambar'])?>" class="img-polaroid" style="margin: 5px 0px 15px;"/>
            <p>
                <?php echo substr($artikel['isi'],0,500)?>
                <br/>
                <a href="<?php echo app_base_url('artikel/detail?id='.$artikel['id'])?>">Continue »</a>
            </p>
        </div>
        <?php endforeach;?>
    </div>
</div>