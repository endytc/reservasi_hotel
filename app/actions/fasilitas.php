<?php
$kategoriFasilitas=  _select_arr("select * from kategori_fasilitas");
$id_kategori=null;
$where='';
if(isset($_GET['id_kategori']) && $_GET['id_kategori']!=''){
    $where=" and id_kategori='$_GET[id_kategori]'";
    $id_kategori=$_GET['id_kategori'];
}
$fasilitasList = _select_arr("
    select fasilitas.*,k.nama as kategori from fasilitas
    join kategori_fasilitas k on fasilitas.id_kategori=k.id
    where 1=1 $where
");
?>
<div class="titleHeader clearfix">
        <h3>Fasilitas Pendukung</h3>
</div><!--end titleHeader-->
<div class="row-fluid">
    <div class="span2"></div>
    <div class="span10" style="text-align: right">
        <form>
            <select onchange="submit(this)" name="id_kategori">
                <option value="">- Semua -</option>
                <?php
                foreach($kategoriFasilitas as $kat){
                    echo "<option value='$kat[id]' ".($kat['id']==$id_kategori?'selected':'').">$kat[nama]</option>";
                }
                ?>
            </select>
        </form>
    </div>
</div>
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
                    <img src="<?php echo app_base_url(file_exists($fasilitas['gambar'])?$fasilitas['gambar']:'upload/not-found.png')?>" alt="" style="width: 100px;height: 72px">
                </td>
                <td class=""><?php echo $fasilitas['nama']?></td>
                <td class="desc">
                    <?php echo $fasilitas['keterangan']?>
                </td>
                <td class="" style="text-align: right;padding-right: 10px"><?php echo rupiah($fasilitas['harga'])?></td>
                <td class=""><?php echo $fasilitas['kategori']?></td>
            </tr>
                    <?php
            }
            ?>
        </tbody>
    </table>
</div><!--end span12-->
