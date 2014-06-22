<?php

if($_POST){
        $_POST['personal']['id_member']=$_SESSION['id_user'];
        $is_success         = _insert('kritik', $_POST['personal']);
        if($is_success){
            $_SESSION['success']="Terimkasih atas saran dan kritiknya";
            redirect('');
        }else{
            $_SESSION['failed']="Saran dan kritik anda gagal disimpan";

        }
    
}
?>
<div class="span12">
    <div class="">

        <div class="titleHeader clearfix">
            <h3>Halaman Kritik dan Saran</h3>
        </div><!--end titleHeader-->
        <label>Silakan isikan kritik dan saran anda di kolom yang tersedia</label>
        <form method="POST" action="<?php echo app_base_url('checkin/kritiksaran')?>" class="form-horizontal" id="registrasi-form">
            <div class="control-group ">
                <label class="control-label" >Kritik</label>
                <div class="controls">
                    <textarea name="personal[kritik]" class="required" id="" placeholder=""></textarea>
                </div>
            </div>
			
			<div class="control-group ">
                <label class="control-label" >Saran</label>
                <div class="controls">
                    <textarea name="personal[saran]" class="required" id="" placeholder=""></textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div><!--end control-group-->

        </form>    

    </div><!--end-->
</div><!--end span9-->
<script type="text/javascript">
    $(document).ready(function(){
       $('#registrasi-form').validate({
            rules:{
                ulangi_password:{
                    equalTo:'#password'
                }
            },
            messages:{
                ulangi_password: 'Password not match'
            }
        });
    });
</script>