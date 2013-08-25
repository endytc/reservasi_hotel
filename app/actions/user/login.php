<div class="span9">
        <table class="table-bordered">
            <tr style="vertical-align: top;">
                <td width="50%" style="padding: 0 1em 0 1em">
                    <h3>Daftar</h3>
                    <p>Jika anda belum mempunyai akun, anda harus mendaftarkan diri terlebih dahulu, 
                        dengan mendaftar anda bisa melihat data booking kamar kapanpun dan dimanapun</p>
                    <a href="<?php echo app_base_url('user/registrasi')?>" class="btn">Register</a>
                </td>

                <td width="50%" style="padding: 0 1em 0 1em">
                    <h3>Login</h3>
                    <form method="POST" action="<?php echo app_base_url('user/proses')?>" class="" id="login">
                        <div class="controls">
                            <label>Username: </label>
                            <input type="text" name="username" value="" class="required">
                        </div>
                        <div class="controls">
                            <label>Password: <span class="text-error">*</span></label>
                            <input type="password" name="password" value="" placeholder="**************" class="required">
                        </div>
                        <div class="controls">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form><!--end form-->
                </td>
            </tr>
        </table>
</div><!--end span9-->
<script type="text/javascript">
$(document).ready(function(){
    $('#login').validate();
})
</script>