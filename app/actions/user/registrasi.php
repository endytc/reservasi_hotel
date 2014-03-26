<div class="span12">
    <div class="register">

        <div class="titleHeader clearfix">
            <h3>Create New Account</h3>
        </div><!--end titleHeader-->

        <form method="POST" action="<?php echo app_base_url('user/registrasi_proses')?>" class="form-horizontal" id="registrasi-form">
            <legend>&nbsp;&nbsp;&nbsp;&nbsp;1. Data Personal</legend>
            <div class="control-group ">
                <label class="control-label" >Nama </label>
                <div class="controls">
                    <input type="text" name="personal[nama]" class="required" id="" placeholder="">
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" >Email</label>
                <div class="controls">
                    <input type="text" name="member[email]" class="email required" id="" placeholder="example@example.com">
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" >Alamat</label>
                <div class="controls">
                    <textarea name="personal[alamat]" class="required" id="" placeholder=""></textarea>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" >Tanda Pengenal</label>
                <div class="controls">
                    <select name="personal[tanda_pengenal]" class="required">
                        <option value="">- Pilih Tanda Pengenal -</option>
                        <?php
                        foreach(get_tanda_pengenal_list() as $tandaPengenal){
                            echo "<option value='$tandaPengenal'>$tandaPengenal</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" >No Data Pengenal</label>
                <div class="controls">
                    <input type="text" name="personal[no_tanda_pengenal]"class="required" id="" placeholder="">
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" >No Telp.</label>
                <div class="controls">
                    <input type="text" name="personal[no_hp]"class="required" id="" placeholder="">
                </div>
            </div>

            <div class="control-group ">
            <legend>&nbsp;&nbsp;&nbsp;&nbsp;2. Akun Untuk Login</legend>

            <div class="control-group">
                <label class="control-label" for="inputPass">Username</label>
                <div class="controls">
                    <input type="text" name="member[username]" class="required">
                </div>
            </div><!--end control-group-->
            <div class="control-group">
                <label class="control-label" for="inputPass">Password: </label>
                <div class="controls">
                    <input type="password" name="member[password]" id="password" placeholder="**********" class="required">
                </div>
            </div><!--end control-group-->

            <div class="control-group">
                <label class="control-label" for="inputConPass">Re-Type Password: </label>
                <div class="controls">
                    <input type="password" name="ulangi_password" id="inputConPass" placeholder="**********">
                </div>
            </div><!--end control-group-->

            <hr>

            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="konfirmasi" class="required"> Saya yakin, bahwa data yang saya masukkan benar
                    </label>
                    <br>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div><!--end control-group-->

        </form><!--end form-->

    </div><!--end register-->
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