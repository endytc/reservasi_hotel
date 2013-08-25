<?php
_query("update kelas set star=star+1 where id='$_GET[id_kelas]'");
$_SESSION['success']='Terimakasih atas partisipasi anda dalam pemberian polling ';
redirect('kamar');
?>
