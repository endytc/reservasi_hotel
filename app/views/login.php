<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo app_base_url() ?>/assets/css/bootstrap.min.css" media="screen">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="<?php echo app_base_url() ?>/assets/css/jquery-ui-1.10.1.min.css">
    <link rel="stylesheet" href="<?php echo app_base_url() ?>/assets/css/customize.css">
    <link rel="stylesheet" href="<?php echo app_base_url() ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo app_base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo app_base_url() ?>/assets/css/jquery.validate.css">
    <!--<link rel="stylesheet" href="<?php echo app_base_url() ?>/assets/css/flexslider.css">-->
    <link rel="stylesheet" href="<?php echo app_base_url() ?>/assets/js/fancybox/jquery.fancybox.css">
    <link rel="shortcut icon" href="<?php echo app_base_url() ?>/assets/images/favicon.html">
    <link rel="apple-touch-icon" href="<?php echo app_base_url() ?>/assets/images/apple-touch-icon.html">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo app_base_url() ?>/assets/images/apple-touch-icon-72x72.html">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo app_base_url() ?>/assets/images/apple-touch-icon-114x114.html">
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <script src="<?php echo app_base_url() ?>/assets/js/jquery.1.8.3.js"></script>
    <script src="<?php echo app_base_url() ?>/assets/js/jquery.ui.1.10.1.min.js"></script>
    <script src="<?php echo app_base_url() ?>/assets/js/jquery.cookie.js"></script>
    <script src="<?php echo app_base_url() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo app_base_url() ?>/assets/js/jquery.flexslider-min.js"></script>
    <script src="<?php echo app_base_url() ?>/assets/js/jquery.cycle2.min.js"></script>
    <script src="<?php echo app_base_url() ?>/assets/js/jquery.cycle2.carousel.min.js"></script>
    <script src="<?php echo app_base_url() ?>/assets/js/jquery.tweet.js"></script>
    <!--<script src="<?php echo app_base_url() ?>/assets/js/jquery.placeholder.min.html"></script>-->
    <script href="<?php echo app_base_url() ?>/assets/js/fancybox/jquery.fancybox.js"></script>
    <script src="<?php echo app_base_url() ?>/assets/js/custom.js"></script>
    <script src="<?php echo app_base_url() ?>/assets/js/jquery.validate.js"></script>
</head>

<body style="background: #ffffff">
    <div class="container-fluid">
        <div class="row-fluid">

            <div class="row-fluid">
                <div class="span12 center login-header">
                    <h2>Login Admin</h2>
                </div><!--/span-->
            </div><!--/row-->

            <div class="row-fluid">
                <div class="well span5 center login-box">
                    <div class="alert alert-info">
                        Please login with your Username and Password.
                    </div>
                    <form action='<?php echo app_base_url('pageadmin/login/proses') ?>' method='POST' >
                        <fieldset>
                            <div class="input-prepend" title="Username" data-rel="tooltip">
                                <span class="add-on"><i class="icon-user"></i></span>
                                <input autofocus class="input-large span10" name="username" id="username" type="text" />
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend" title="Password" data-rel="tooltip">
                                <span class="add-on"><i class="icon-lock"></i></span>
                                <input class="input-large span10" name="password" id="password" type="password" value="" />
                            </div>
                            <div class="clearfix"></div>

                            <div class="input-prepend">
                                <label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
                            </div>
                            <div class="clearfix"></div>

                            <p class="center span5">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </p>
                        </fieldset>
                    </form>
                </div><!--/span-->
            </div><!--/row-->
        </div><!--/fluid-row-->

    </div><!--/.fluid-container-->
    <script type="text/javascript">
<?php
if (isset($_SESSION['success'])) {
    echo "noticeSuccess('$_SESSION[success]')";
    unset($_SESSION['success']);
}
if (isset($_SESSION['failed'])) {
    echo "noticeFailed('$_SESSION[failed]')";
    unset($_SESSION['failed']);
}
?>
    </script>
</body>
</html>

