
<?php
$group="";
$where="is_published=1";
if(isset($_GET['group']) && $_GET['group']!=''){
    $where.=" and id_kategori='$_GET[group]'";
    $group=  _select_unique_result("select * from kategori_artikel where id='$_GET[group]'");
    $group="<div class='titleHeader clearfix'>
<h3>$group[nama]</h3>
</div><br>";
}
$artikel=  _select_arr("select *,artikel.id as id_artikel,date(waktu_post) as tanggal, 
    time(waktu_post) as jam  
    from artikel 
    where $where 
        order by waktu_post desc
        limit 0,10 
        
        ");
echo $group;
$is_firts=true;
foreach($artikel as $art){
    ?>
        <article class="blog-article">
					<div class="row">
						<div class="span4">
							<div class="blog-img">
                                                            <img src="<?php echo app_base_url($art['path_gambar'])?>" alt="Blog image" style="width: 350px;height: 300px">
							</div><!--end blog-img-->
						</div><!--end span4-->

						<div class="span8">
							<div class="blog-content">
								<div class="blog-content-title">
									<h2><a href="<?php echo app_base_url('artikel/detail?id='.$art['id'])?>" class="invarseColor"><?php echo $art['judul']?></a></h2>
								</div>
								<div class="clearfix">
									<ul class="unstyled blog-content-date">
										<!--<li class="pull-right"><i class="icon-comments"></i> 15</li>-->
										<li class="pull-left"><i class="icon-calendar"></i> <?php echo datefmysql($art['tanggal'])." $art[jam]"; ?></li>
										<!--<li class="pull-left"><i class="icon-pencil"></i> <a href="#">Huseyin</a></li>-->
									</ul>
								</div>
								<div class="blog-content-entry" class="artikel">
									<p>
										<?php echo substr($art['isi'],0,500)?>
									</p>
                                                                        <a href="<?php echo app_base_url('artikel/detail?id='.$art['id'])?>">Continue &rarr;</a>
								</div>
							</div><!--end blog-content-->
						</div><!--end span5-->
					</div><!--end row-->
					</article><!--end article-->

        <?php
    if($is_firts){
        $is_firts=false;
    }
}
?>
<div class='artikel' style='inline-box-align: inherit'></div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".artikel").truncatable({limit: 75, more: '&nbsp;<strong class=readmore>read more</strong>', less: true, hideText: '&nbsp;<strong class=readmore>[sembunyikan]</strong>' }); 
       $('a[href=#]').click(function(event){
            event.preventDefault();
        });
    });
</script>