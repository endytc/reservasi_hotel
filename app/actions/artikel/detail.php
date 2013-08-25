<?php
$art= _select_unique_result("select *,artikel.id as id_artikel,date(waktu_post) as tanggal, time(waktu_post) as jam  from artikel where id='$_GET[id]'");
echo "<h2 style='font-size: 2em'><a href=".  app_base_url('artikel/detail?id='.$art['id_artikel']).">$art[judul]</a></h2> di posting pada ".datefmysql($art['tanggal'])." $art[jam]<hr>";
echo '<div class="pull-left" style="padding-right: 0.7em"><img src="'.app_base_url($art['path_gambar']).'" class="img-rounded" width=100/></div>'.
            "<div class='artikel' style='inline-box-align: inherit'>";
    echo $art['isi'];
    echo "</div>";
?>
