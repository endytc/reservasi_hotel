<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Reservasi Hotel</title>
	<meta name="description" content="">
	<meta name="author" content="Ahmed Saeed">
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/bootstrap.min.css" media="screen">
	<!-- jquery ui css -->
	<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/jquery-ui-1.10.1.min.css">
	<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/customize.css">
	<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/style.css">
	<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/jquery.validate.css">
	<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/flexslider.css">
	<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/jquery.autocomplete.css">
	<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/js/fancybox/jquery.fancybox.css">
	<link rel="shortcut icon" href="<?php echo app_base_url()?>/assets/images/favicon.html">
	<link rel="apple-touch-icon" href="<?php echo app_base_url()?>/assets/images/apple-touch-icon.html">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo app_base_url()?>/assets/images/apple-touch-icon-72x72.html">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo app_base_url()?>/assets/images/apple-touch-icon-114x114.html">
        
        <!-- JS
	================================================== -->
	<!--<script src="<?php echo app_base_url()?>/assets/js/jquery.1.9.1.min.js"></script>-->
	<script src="<?php echo app_base_url()?>/assets/js/jquery.1.8.3.js"></script>
	<script src="<?php echo app_base_url()?>/assets/js/jquery.ui.1.10.1.min.js"></script>
	<script src="<?php echo app_base_url()?>/assets/js/jquery.cookie.js"></script>
        <script src="<?php echo app_base_url()?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo app_base_url()?>/assets/js/jquery.flexslider-min.js"></script>
        <script src="<?php echo app_base_url()?>/assets/js/jquery.cycle2.min.js"></script>
        <script src="<?php echo app_base_url()?>/assets/js/jquery.cycle2.carousel.min.js"></script>
        <script src="<?php echo app_base_url()?>/assets/js/jquery.tweet.js"></script>
        <script src="<?php echo app_base_url()?>/assets/js/jquery.truncatable.js"></script>
        <script src="<?php echo app_base_url()?>/assets/js/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="<?php echo app_base_url('assets/js/tiny_mce/jquery.tinymce.js')?>"></script>
        <script src="<?php echo app_base_url()?>/assets/js/custom.js"></script>
        <script src="<?php echo app_base_url()?>/assets/js/jquery.validate.js"></script>
    
    <script type="text/javascript">
$().ready(function() {
                $('textarea.tinymce').tinymce({
                    // Location of TinyMCE script
                    script_url : '<?php echo app_base_url('assets/js/tiny_mce/tiny_mce.js')?>',

                    // General options
                    theme : "advanced",
                    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

                    // Theme options
                    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                    theme_advanced_buttons2 : "cut,copy,paste,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,cleanup,code,preview,|,forecolor,backcolor",
//                    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
//                    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_resizing : true,

                    // Example content CSS (should be your site CSS)
                    content_css : "<?php echo app_base_url('assets/css/content.css')?>",

                    // Drop lists for link/image/media/template dialogs
//                    template_external_list_url : "lists/template_list.js",
//                    external_link_list_url : "lists/link_list.js",
//                    external_image_list_url : "lists/image_list.js",
//                    media_external_list_url : "lists/media_list.js",

                    // Replace values for the template plugin
                    template_replace_values : {
                        username : "Some User",
                        staffid : "991234"
                    }
                });
            });
</script>
</head>