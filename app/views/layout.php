<?php include 'app/views/head.php';?>
<body>
	<div id="mainContainer" class="clearfix">
		<!--begain header-->
		<header>
			<div class="upperHeader">
				<div class="container">
					<ul class="pull-right inline">
                                            <?php if(is_login() && is_member()){?>    
						<li><a class="invarseColor" href="<?php echo app_base_url('user/profile')?>">My Account</a></li>
						<li class="divider-vertical"></li>
                                                <?php
                                                $user=  get_user_login();
                                                $jumlahPesanan=  _select_unique_result("select count(*) as jumlah from detail_checkin where id_checkin is null and id_pengunjung='$user[id_pengunjung]'");
                                                ?>
						<li><a class="invarseColor" href="<?php echo app_base_url('checkin/detail_checkin')?>">List Pesanan (<?php echo $jumlahPesanan['jumlah']?>)</a></li>
						<li class="divider-vertical"></li>
						<li><a class="invarseColor" href="<?php echo app_base_url('checkin/history_checkin')?>">History</a></li>
                                                <li class="divider-vertical"></li>
                                                <li><a class="invarseColor" href="<?php echo app_base_url('user/logout')?>">Logout</a></li>
                                             <?php }?>
					</ul>
					<p>
                                        <?php if(!is_login()){?>    
					Welcome to Graha Prima Hotel, <a href="<?php echo app_base_url('user/login')?>">Login</a> or <a href="<?php echo app_base_url('user/registrasi')?>">Create new account</a>
                                        <?php }else{?>
                                        <?php 
                                        $user=  get_user_login();
                                        echo "Login As: $user[nama]";
                                        }?>
					</p>
				</div><!--end container-->
			</div><!--end upperHeader-->

			<div class="middleHeader">
				<div class="container">

					<div class="middleContainer clearfix">

					<div class="siteLogo pull-left">
						<h1><a href="<?php echo app_base_url()?>">ShopFine</a></h1>
					</div>
                                            <?php
                                            $user=  get_user_login();
                                            $pengunjung=  _select_unique_result("select * from pengunjung where id='$user[id]'");
                                            $nilaiPoin=  _select_unique_result("select * from setting where kd='nilai_poin'");
                                            if($user!=null){
                                            ?>
                                            <div class="pull-right" style="padding-left: 2em">
                                                <table class="table-bordered">
                                                    <tr style="background-color: #d5d5d5">
                                                        <td>Poin Anda:</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: center;font-size: 2em">
                                                            <?php echo $pengunjung['jumlah_poin']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #d5d5d5">
                                                            <?php echo rupiah($nilaiPoin['isi'], false) ?> /poin
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div><!--end pull-right-->
                                            <?php }?>
					<div class="pull-right">
						<?php include 'app/actions/items_on_list.php';?>
					</div><!--end pull-right-->

					</div><!--end middleCoontainer-->

				</div><!--end container-->
			</div><!--end middleHeader-->

			<div class="mainNav">
				<div class="container">
					<div class="navbar">
                                            <ul class="nav">
                                                <?php
                                                foreach (get_user_menu() as $menu) {
                                                    ?><li class="">
                                                        <a href="<?php echo app_base_url($menu['url']) ?>">
                                                            <?php echo (isset($menu['icon']) && $menu['icon'] != '') ? "<i class='$menu[icon]'></i>" : '' ?> 
                                                            <?php echo $menu['title'] ?>
                                                            <?php echo (isset($menu['submenu']) && count($menu['submenu'])>0)?'<i class="icon-caret-down"></i>':''?>
                                                        </a>
                                                        <?php 
                                                        if(isset($menu['submenu']) &&   count($menu['submenu'])>0){
                                                            echo "<div><ul>";
                                                            foreach($menu['submenu'] as $submenu){?>
                                                    <li>
                                                                <a href="<?php echo app_base_url($submenu['url']) ?>">
                                                                <?php echo (isset($menu['icon']) && $submenu['icon'] != '') ? "<i class='$menu[icon]'></i>" : '' ?> 
                                                                <?php echo $submenu['title'] ?>
                                                                </a>
                                                        </li>
                                                            <?php }echo "</ul></div>";
                                                            
                                                        }?>
                                                    </li><?php
                                                }
                                                echo (is_login())?'<li><a href="'.  app_base_url('user/logout').'">Logout</a></li>':'';
                                                ?>
                                            </ul><!--end nav-->
				</div><!--end container-->
			</div><!--end mainNav-->	
			
		</header>
		<!-- end header -->



		<div class="container" style="min-height: 350px">
                        <div class="modal hide fade" id="myModelDialog" ></div>
                        <div class="modal hide fade" id="myModal"></div>

                        <div class="row">
                            <?php
                            $isShowMessage=true;
                            if(isset($_SESSION['success'])){
                                $alert='alert-success';
                                $pesan=$_SESSION['success'];
                                unset($_SESSION['success']);
                            }else if(isset($_SESSION['failed'])){
                                $alert='alert-error';
                                $pesan=$_SESSION['failed'];
                                unset($_SESSION['failed']);
                            }else{
                                $isShowMessage=false;
                            }
                            if($isShowMessage):?>    
                            <div class="alert <?php echo $alert;?>">
                                    <button type="button" class="close" data-dismiss="alert"> x </button>
                                    <?php echo $pesan?>
                            </div><!--alert-->
                            <?php endif;?>
                            <?php echo $_content?>
			</div><!--end row-->
		</div><!--end conatiner-->


		<!--begain footer-->
<!--		<footer>
		<div class="footerOuter">
			<div class="container">
				<div class="row-fluid">

					<div class="span6">
						<div class="titleHeader clearfix">
							<h3>Usefull Links</h3>
						</div>

						
						<div class="usefullLinks">
							<div class="row-fluid">
								<div class="span6">
									<ul class="unstyled">
										<li><a class="invarseColor" href="<?php echo app_base_url()?>/assets/#"><i class="icon-caret-right"></i> About Us</a></li>
										<li><a class="invarseColor" href="<?php echo app_base_url()?>/assets/#"><i class="icon-caret-right"></i> Delivery Information</a></li>
										<li><a class="invarseColor" href="<?php echo app_base_url()?>/assets/#"><i class="icon-caret-right"></i> Privecy Police</a></li>
										<li><a class="invarseColor" href="<?php echo app_base_url()?>/assets/#"><i class="icon-caret-right"></i> Tarms &amp; Condations</a></li>
									</ul>
								</div>

								<div class="span6">
									<ul class="unstyled">
										<li><a class="invarseColor" href="<?php echo app_base_url()?>/assets/#"><i class="icon-caret-right"></i> Surf Brands</a></li>
										<li><a class="invarseColor" href="<?php echo app_base_url()?>/assets/#"><i class="icon-caret-right"></i> Customer Support</a></li>
										<li><a class="invarseColor" href="<?php echo app_base_url()?>/assets/#"><i class="icon-caret-right"></i> Special Gifs</a></li>
										<li><a class="invarseColor" href="<?php echo app_base_url()?>/assets/#"><i class="icon-caret-right"></i> Browse Site Map</a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>end span6

					<div class="span3">
						<div class="titleHeader clearfix">
							<h3>Contact Info</h3>
						</div>

						<div class="contactInfo">
							<ul class="unstyled">
								<li>
									<button class="btn btn-small">
										<i class="icon-volume-up"></i>
									</button>
									Call Us: <a class="invarseColor" href="<?php echo app_base_url()?>/assets/#">5246-4697-891</a>
								</li>
								<li>
									<button class="btn btn-small">
										<i class="icon-envelope-alt"></i>
									</button>
									<a class="invarseColor" href="<?php echo app_base_url()?>/assets/#">grahaprima@grahaprima.com</a>
								</li>
								<li>
									<button class="btn btn-small">
										<i class="icon-map-marker"></i>
									</button>
									22 Avenue Park, Los Angeles
								</li>
							</ul>
						</div>

					</div>end span3

					<div class="span3">
						<div class="titleHeader clearfix">
							<h3>Newslatter</h3>
						</div>

						<div class="newslatter">
							<form method="#" action="#">
								<input class="input-block-level" type="text" name="email" value="" placeholder="Your Name..." Name="">
								<input class="input-block-level" type="text" name="email" value="" placeholder="Your E-Mail..." Name="">
								<button class="btn btn-block" type="submit" name="">Join Us Now</button>
							</form>
						</div>

					</div>end span3

				</div>end row-fluid

			</div>end container
		</div>end footerOuter-->
                <hr>
		<div class="container">
			<div class="row">
				<div class="span12">
					<ul class="payments inline pull-right">
						<li class="visia"></li>
						<li class="paypal"></li>
						<li class="electron"></li>
						<li class="discover"></li>
					</ul>
					<p>© Copyrights 2012 for grahaprima.com</p>
				</div>
			</div>
		</div>
		</footer>
		<!--end footer-->

	</div><!--end mainContainer-->


	<!-- Sidebar Widget
	================================================== -->
	<div class="switcher">
		<h3>Site Switcher</h3>
		<a class="Widget-toggle-link">+</a>

		<div class="switcher-content clearfix">
			<div class="layout-switch">
				<h4>Layout Style</h4>
				<div class="btn-group">
					<a id="wide-style" class="btn">Wide</a>
	  				<a id="boxed-style" class="btn">Boxed</a>
				</div>
			</div><!--end layout-switch-->

			<div class="color-switch clearfix">
				<h4>Color Style</h4>
				<a id="orange-color" class="color-switch-link">orange</a>
				<a id="blue-color" class="color-switch-link">blue</a>
				<a id="green-color" class="color-switch-link">green</a>
				<a id="brown-color" class="color-switch-link">brown</a>
				<a id="red-color" class="color-switch-link">red</a>
			</div><!--end color-switch-->

			<div class="pattern-switch">
				<h4>BG Pattern</h4>
				<a style="background:url(img/backgrounds/retina_wood.png);">retina_wood</a>
				<a style="background:url(img/backgrounds/bgnoise_lg.png);">bgnoise_lg</a>
				<a style="background:url(img/backgrounds/purty_wood.png);">purty_wood</a>
				<a style="background:url(img/backgrounds/irongrip.png);">irongrip</a>
				<a style="background:url(img/backgrounds/low_contrast_linen.png);">low_contrast_linen</a>
				<a style="background:url(img/backgrounds/tex2res5.png);">tex2res5</a>
				<a style="background:url(img/backgrounds/wood_pattern.png);">wood_pattern</a>
			</div><!--end pattern-switch-->

		</div><!--end switcher-content-->
	</div>
	<!-- End Sidebar Widget-->
	

<script src="<?php echo app_base_url()?>/assets/js/tambahan/dialog.js"></script>    
<script type="text/javascript">
var __lc = {};
__lc.license = 3336332;

(function() {
	var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
	lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
</body>

</html>