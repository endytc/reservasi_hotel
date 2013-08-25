<?php
return array(
    array(
        'title'=>'Master Data',
        'menu'=>array(
            array('url'=>'kategori_artikel/index','title'=>'Kategori Artikel','privilege'=>array('admin')),
            array('url'=>'artikel/index','title'=>'Artikel','privilege'=>array('admin','ahli_gizi')),
            array('url'=>'kategori/index','title'=>'Kategori Gejala','privilege'=>array('admin')),
            array('url'=>'gejala/index','title'=>'Gejala','privilege'=>array('admin')),
            array('url'=>'pasien/index','title'=>'Pasien','privilege'=>array('admin')),
            array('url'=>'pekerjaan/index','title'=>'Pekerjaan','privilege'=>array('admin')),
            array('url'=>'treshold/index','title'=>'Treshold','privilege'=>array('ahli_gizi')),
            array('url'=>'admin/index','title'=>'Admin','privilege'=>array('admin')),
            array('url'=>'ahli_gizi/index','title'=>'Ahli Gizi','privilege'=>array('admin')),
            array('url'=>'status_gizi_bb/index','title'=>'Status Gizi BB','privilege'=>array('ahli_gizi')),
            array('url'=>'status_gizi_tb/index','title'=>'Status Gizi TB','privilege'=>array('ahli_gizi')),
        )
    ),
    array(
        'title'=>'Menu Utama',
        'menu'=>array(
            array('url'=>'kasus/index','title'=>'Kasus','privilege'=>array('ahli_gizi','pasien')),
//            array('url'=>'gejala/index','title'=>'Gejala'),
//            array('url'=>'pekerjaan/index','title'=>'Pekerjaan'),
        )
    ),
);
?>
