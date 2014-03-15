<?php
$page=  array_value($_GET, 'pages',1)*  getPerPage()-  getPerPage();
$kamar=  _select_arr("select
  kamar.*,detail.id_kamar,
  sum(
      detail.jam
  ) as jumlah_jam
from kamar
left join (SELECT id_kamar, HOUR( TIMEDIFF( detail_checkin.keluar, detail_checkin.masuk ) ) AS jam
FROM detail_checkin
GROUP BY id_kamar) detail on detail.id_kamar=kamar.id
GROUP BY id_kamar
        limit $page,".  getPerPage());
$pagging= pagination("select * from kamar", getPerPage());
?>
    <h3>Rating Kamar</h3>
    <hr>
    <table class="table table-bordered table-striped table-condensed">
        <thead>
        <tr>
            <th>No</th>
            <th>Kamar</th>
            <th>Jumlah Jam</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=  $page+1;
        foreach($kamar as $data){
        ?>
        <tr>
            <td><?php echo $i++;?></td>
            <td><?php echo $data['nama'];?></td>
            <td><?php echo $data['jumlah_jam']?></td>
        </tr>
        </tbody>
        <?php
        }
        ?>
    </table>
<?php echo $pagging?>