<?php
$pengunjung=  _select_arr("select * from fasilitas where nama like '%$_POST[q]%'");
echo json_encode($pengunjung);
exit;
?>
