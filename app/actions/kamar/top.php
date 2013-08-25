<?php
$kelasWithGambar=  _select_arr("select * from kelas where kelas.gambar<>''");
$fasilitasList=  _select_arr("select * from fasilitas");
?>
<div class="span8">
    <div class="flexslider">
        <ul class="slides">
            <?php 
            $i=1;
            foreach ($kelasWithGambar as $kelas){
                if(file_exists($kelas['gambar'])){
                    ?><li><img src="<?php echo app_base_url($kelas['gambar'])?>" slt="<?php echo "slide".($i++)?>" style="width: 800px;height: 300px;"></li><?php
                }
            }
?>
        </ul>
    </div><!--end flexslider-->
</div><!--end span8-->


<div class="span4">

    <div id="homeSpecial">
        <div class="titleHeader clearfix">
            <h3>Fasilitas</h3>
            <div class="pagers">
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <button class="btn btn-mini vNext"><i class="icon-caret-down"></i></button>
                        <button class="btn btn-mini vPrev"><i class="icon-caret-up"></i></button>
                    </div>
                    <a href="<?php echo app_base_url('fasilitas')?>"class="btn btn-mini"> View All</a>
                </div>
            </div>
        </div><!--end titleHeader-->


        <ul class="vProductItems cycle-slideshow vertical clearfix"
            data-cycle-fx="carousel"
            data-cycle-timeout=0
            data-cycle-slides="> li"
            data-cycle-next=".vPrev"
            data-cycle-prev=".vNext"
            data-cycle-carousel-visible="2"
            data-cycle-carousel-vertical="true"
            >
            <?php 
            $i=1;
            foreach ($fasilitasList as $fasilitas){
                    ?>
                    <li class="span4 clearfix">
                        <div class="thumbImage">
                            <a href="#"><img src="<?php echo file_exists($fasilitas['gambar'])?$fasilitas['gambar']:'upload/not-found.png'?>" alt="" style="width: 100px;height: 100px"></a>
                        </div>
                        <div class="thumbSetting">
                            <div class="thumbTitle">
                                <a href="#" class="invarseColor">
                                    <?php echo $fasilitas['nama']?>
                                </a>
                            </div>
                            <div class="thumbPrice">
                                <span><?php echo rupiah($fasilitas['harga'])?></span>
                            </div>
                        </div>
                    </li>
                        <?php
            }
?>
        </ul>
    </div><!--end special-->
</div><!--end span4-->
<div class="clear"></div>