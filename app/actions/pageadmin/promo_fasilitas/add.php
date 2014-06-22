<?php
$setting=  _select_unique_result("select * from setting where kd='minpromo'");
//show_array($_POST);exit;
if($_POST){
    $having=1;
    if($_POST['promo']['transaksi_min']>0 && $_POST['promo']['transaksi_min']!=""){
        $having.=" and totalbiaya>='".$_POST['promo']['transaksi_min']."'";
    }
    if($_POST['promo']['transaksi_max']>0 && $_POST['promo']['transaksi_max']!=""){
        $having.=" and totalbiaya<='".$_POST['promo']['transaksi_max']."'";
    }
    $where=' 1 ';
    if(isset($_POST['lajang']) || isset($_POST['menikah'])){
        $where.=" and ( 0 ";
        if(isset($_POST['lajang'])){
            $where.=" or pengunjung.status='lajang'";
        }
        if(isset($_POST['menikah'])){
            $where.=" or pengunjung.status='menikah'";
        }
        $where.=")";
    }
    $memberList=  _select_arr("select *,
            (select sum(detail_checkin.biaya) from detail_checkin 
            join checkin on checkin.id=detail_checkin.id_checkin
            where checkin.status='approved' and checkin.id_pengunjung=pengunjung.id
            ) as totalbiaya,pengunjung.id as id
             from pengunjung
            join member on member.id_pengunjung=pengunjung.id
            where member.email<>'' and member.email is not null and $where
            having $having");
    
    $is_success         = _insert('promo', $_POST['promo']);
    $lastId=  _select_unique_result("select max(id) as id from promo");
    
    foreach($memberList as $member){
        _insert('promo_pengunjung',array('id_pengunjung'=>$member['id'],'id_promo'=>$lastId['id']));
//        $success=mail($member['email'] , $_POST['promo']['judul'] , $_POST['promo']['isi']);
        
        $mail             = new PHPMailer();
        $body=$_POST['promo']['isi'];

        $mail->IsSMTP();
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port

        $mail->Username   = "grahaprimapct@gmail.com";  // GMAIL username
        $mail->Password   = "jawatimur";            // GMAIL password

        $mail->From       = "grahaprimapct@gmail.com";
        $mail->FromName   = "Graha Prima Hotel Pacitan";
        $mail->Subject    = $_POST['promo']['judul'];
        $mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
        $mail->WordWrap   = 50; // set word wrap

        $mail->MsgHTML($body);

        $mail->AddReplyTo("grahaprimapct@gmail.com","Admin Graha Prima Hotel");

//        $mail->AddAttachment("/path/to/file.zip");             // attachment
//        $mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment

        $mail->AddAddress($member['email'],"First Last");

        $mail->IsHTML(true); // send as HTML
        
        if(!$mail->Send()) {
            $_SESSION['failed']="Promo gagal dikirim";
          } else {
            $_SESSION['success']="Promo berhasil dikirim";
          }
    }
    redirect('pageadmin/promo_fasilitas');
}
$fasilitasList=  _select_arr("select * from fasilitas");

?>
<form action="<?php echo app_base_url('pageadmin/promo_fasilitas/add')?>" method="POST" id="addkelas" class="form-horizontal" enctype="multipart/form-data">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3>Tambah Promosi Fasilitas</h3>
    </div>
    <div class="modal-body">
        <div class="form">    
            <fieldset>
                <div class="control-group">
                    <label class="control-label required">Judul</label>                
                    <div class="controls">
                        <input type="text" class="required" name="promo[judul]" value="">
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label required">Range Transaksi</label>                
                    <div class="controls">
                        <input type="text" name="promo[transaksi_min]" class="span2 number" style="text-align: right"/> 
                        <div style="display:inline">s.d</div> 
                        <input type="text" name="promo[transaksi_max]" class="span2 number" style="text-align: right"/>
                    </div>    
                </div>
				
				<div>
				<div class="control-group">
                    <label class="control-label required">Status</label>                
                    <div class="controls">                        					
						<input type="checkbox" name="lajang" value="Lajang"> Lajang<br>
						<input type="checkbox" name="menikah" value="Menikah"> Menikah 
                    </div>    
                </div>
				</div>
				
				
                <div class="control-group">
                        <textarea name="promo[isi]" class="tinymce" style="width: 100%"></textarea>
                </div>
            </fieldset>
        </div><!-- form -->
</div>
<div class="modal-footer">
    <button class="btn btn-primary" type="submit" name="yt0">Tambah</button>            <a data-dismiss="modal" class="btn btn-warning btn" href="#">Close</a>
</div>    
</form>

<script type="text/javascript">
    $(document).ready(function(){
        $('#addkelas').validate();  
    });
</script>