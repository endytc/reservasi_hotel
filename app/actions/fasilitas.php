<?php
$fasilitasList = _select_arr("
    select fasilitas.*,k.nama as kategori from fasilitas
    join kategori_fasilitas k on fasilitas.id_kategori=k.id
    
");
?>
<h3>Fasilitas Pendukung</h3>
<hr>
<div class="span12">
    <table class="table">
        <thead>
            <tr>
                <th><h5>Gambar</h5></th>
                <th><h5>Nama</h5></th>
                <th class="desc"><h5>Keterangan</h5></th>
                <th><h5>Harga</h5></th>
                <th><h5>Kategori</h5></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($fasilitasList as $fasilitas) {
                ?>
             <tr>
                <td>
                    <img src="<?php echo app_base_url(file_exists($fasilitas['gambar'])?$fasilitas['gambar']:'upload/not-found.png')?>" alt="" style="width: 72px;height: 72px">
                </td>
                <td class=""><?php echo $fasilitas['nama']?></td>
                <td class="desc">
                    <?php echo $fasilitas['keterangan']?>
                </td>
                <td class=""><?php echo $fasilitas['harga']?></td>
                <td class=""><?php echo $fasilitas['kategori']?></td>
            </tr>
                    <?php
            }
            ?>
        </tbody>
    </table>
</div><!--end span12-->
