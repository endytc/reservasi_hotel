<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/elfinder/elfinder.min.css">
<link rel="stylesheet" href="<?php echo app_base_url()?>/assets/css/elfinder/theme.min.css">

<script type="text/javascript" src="<?php echo app_base_url()?>/assets/js/elfinder/elfinder.min.js"></script>
<script type="text/javascript" src="<?php echo app_base_url()?>/assets/js/elfinder/i18n/elfinder.ru.js"></script>
<div id="galery-elfinder"></div>
<script type="text/javascript">
    $(document).ready(function() {
            var elf = $('#galery-elfinder').elfinder({
                    url : '<?echo app_base_url()?>/elfinder/connector.php'  // connector URL (REQUIRED)
                    // lang: 'ru',             // language (OPTIONAL)
            }).elfinder('instance');
    });
</script>