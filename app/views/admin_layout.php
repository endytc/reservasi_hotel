<?php include 'app/views/head.php';?>
<body>
	<div id="mainContainer" class="clearfix">
		<!--begain header-->
		<header>

                    <div class="mainNav" style="height: 70px">
				<div class="container">
                                    <div class="navbar" style="width: 100%">
                                        <div class="span5">
                                            <img src="<?php echo app_base_url() ?>/assets/img/graha-prima.png">
                                        </div>
                                        <div class="span6" style="text-align: right">
                                            <?php
                                            $user = get_user_login();
                                            if ($user['type'] == 'operator') {
                                                ?><div style="font-size: 1.5em;">Halaman Operator, <?php echo $user['nama'] ?></div><?php
                                            } else {
                                                ?><div style="font-size: 1.5em;">Halaman Admin, <?php echo $user['nama'] ?></div><?php
                                            }
                                            ?>
                                        </div>
					</div>
				</div><!--end container-->
			</div><!--end mainNav-->	
			
		</header>
		<!-- end header -->



		<div class="container">
                        <div class="modal hide fade" id="myModelDialog" ></div>
                        <div class="modal hide fade" id="myModal"></div>

                        <div class="row">
                            <div class="span3">
                                <ul class="unstyled my-account">
                                    <?php
                                    foreach (getMenuAdmin() as $m) {
                                            $param = array();
                                            if (isset($m['param'])) {
                                                $param = $m['param'];
                                            }
                                            $pageuser=(is_admin())?'pageadmin':'pageoperator';
                                            ?><li class=""><a class="invarseColor" href="<?php echo app_base_url("$pageuser/".$m['url']) ?>"><i class="icon-caret-right"></i> <span class="hidden-tablet"><?php echo $m['title'] ?></span></a></li><?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="span9" id="content" style="min-height: 420px">
                                <div id="alertMessage"></div>    
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
                            ?>    
                            <?php if($isShowMessage):?>    
                            <div class="alert <?php echo $alert;?>">
                                    <button type="button" class="close" data-dismiss="alert"> x </button>
                                    <?php echo $pesan?>
                            </div><!--alert-->
                            <?php endif;?>
                                <?php echo $_content?>
                            </div>
                            
			</div><!--end row-->
		</div><!--end conatiner-->

		<!--begain footer-->
                <footer style="">

		<div class="container">
			<div class="row">
				<div class="span12">
					<ul class="payments inline pull-right">
                                            <?php 
                                            $bank=  _select_arr("select * from bank");
                                            foreach ($bank as $value) {
                                                echo "<li><a href=".  app_base_url('bank?id='.$value['id'])." target='ajax-modal'><img src='".  app_base_url($value['gambar'])."' width=30 height=20></a></li>";
                                            }
                                            ?>
					</ul>
					<p>© Copyrights 2012 for shopfine.com</p>
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
	
<!--<script href="<?php echo app_base_url()?>/assets/js/fancybox/jquery.fancybox.js"></script>
--><script src="<?php echo app_base_url()?>/assets/js/tambahan/dialog.js"></script>    
</body>

</html>