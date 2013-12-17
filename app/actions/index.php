<?php
//$kelasQry=  _select_arr("select *,(select count(*) from kamar where kamar.id_kelas=kelas.id) as jumlah_kamar from kelas");
$artikelList =  _select_arr("select *,artikel.id as id_artikel,date(waktu_post) as tanggal, 
    time(waktu_post) as jam  
    from artikel 
        order by waktu_post desc
        limit 0,3 
        
        ");

include 'app/actions/kamar/top.php';

?>
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