<!DOCTYPE html>
<html>
    <head>
        <title>SISTEM REKOMENDASI</title>
        <link rel="stylesheet" href="<?php echo app_base_url()?>/style.css" />
        <link rel="stylesheet" href="<?php echo app_base_url()?>/general.css" />
        <link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/ui/jquery.ui.all.css" />
        <link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/token-input.css" />
        <link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/token-input-facebook.css" />
        <link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/jquery.validate.css" />
        <link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/notice.css" />
        
        <script type="text/javascript" src="<?php echo app_base_url('assets/js/jquery-1.7.2.js')?>"></script>
        <script type="text/javascript" src="<?php echo app_base_url('assets/js/ui/jquery.ui.core.js')?>"></script>
        <script type="text/javascript" src="<?php echo app_base_url('assets/js/ui/jquery.ui.datepicker.js')?>"></script>
        <script type="text/javascript" src="<?php echo app_base_url('assets/js/token-input.js')?>"></script>
        <script type="text/javascript" src="<?php echo app_base_url('assets/js/jquery.validate.js')?>"></script>
        <script type="text/javascript" src="<?php echo app_base_url('assets/js/tiny_mce/jquery.tinymce.js')?>"></script>
        <script type="text/javascript" src="<?php echo app_base_url('assets/js/jquery.truncatable.js')?>"></script>
        <script type="text/javascript" src="<?php echo app_base_url('assets/js/common.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.tanggal').datepicker();
            })
        </script>
    </head>
    <body>
        <div class="BackgroundGradient"> </div>
        <div class="BodyContent">

            <div class="BorderBorder">
                <div class="BorderBL"><div></div></div>
                <div class="BorderBR"><div></div></div><div class="BorderTL"></div><div class="BorderTR"><div></div></div><div class="BorderT"></div><div class="BorderR"><div></div></div><div class="BorderB"><div></div></div><div class="BorderL"></div><div class="BorderC"></div><div class="Border">
                        <div class="MainColumn">
                            <br>
                            <div id="message">
                            </div>
                            <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div>
                                <div class="Article">
                                    <?php echo $_content;?>
                                </div>
                            </div>
                            </div>
                </div></div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.form').submit(function(){
                    $(this).valid();
                });
            })
        </script>
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
            
            <?php
            if(isset($_SESSION['success'])){
                echo "noticeSuccess('$_SESSION[success]')";
                unset($_SESSION['success']);
            }
            if(isset($_SESSION['failed'])){
                echo "noticeFailed('$_SESSION[failed]')";
                unset($_SESSION['failed']);
            }
            
            ?>
        </script>
    </body>
</html>