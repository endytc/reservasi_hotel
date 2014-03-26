<?php
ini_set('display_startup_errors', true);
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

/**
 *
 * @param <type> $tgl d/m/y
 * @return <type>
 */
function indo_tgl($tgl, $type=null) {
    if ($type == null) {
        $type = "/";
    }
    $tgl = explode($type, $tgl);
    if ($tgl[1] == '01')
        $mo = "Januari";
    if ($tgl[1] == '02')
        $mo = "Februari";
    if ($tgl[1] == '03')
        $mo = "Maret";
    if ($tgl[1] == '04')
        $mo = "April";
    if ($tgl[1] == '05')
        $mo = "Mei";
    if ($tgl[1] == '06')
        $mo = "Juni";
    if ($tgl[1] == '07')
        $mo = "Juli";
    if ($tgl[1] == '08')
        $mo = "Agustus";
    if ($tgl[1] == '09')
        $mo = "September";
    if ($tgl[1] == '10')
        $mo = "Oktober";
    if ($tgl[1] == '11')
        $mo = "November";
    if ($tgl[1] == '12')
        $mo = "Desember";
    $new = "$tgl[0] $mo $tgl[2]";

    return $new;
}

function date2mysql($tgl) {
    $new = null;
    $tgl = explode("/", $tgl);
    if (empty($tgl[2]))
        return "";
    $new = "$tgl[2]-$tgl[1]-$tgl[0]";
    return $new;
}
/**
 * 
 * @param type $time yyyy-mm-dd H:m:s
 * @return type dd-mm-yyyy H:m:s
 */
function timeFormatFromMysql($time){
    $time=  explode(' ', $time);
    return datefmysql($time[0]).' '.$time[1];
}

function datefmysql($tgl) {
	if($tgl=='' || $tgl==null){
		return "-";
    }else{
	$tgl = explode("-", $tgl);
    $new = $tgl[2]."/".$tgl[1]."/".$tgl[0];
    return $new;
	}
}
function parse_datetime($datetime){
    $datetime=  explode(' ', $datetime);
    return datefmysql($datetime[0]).' '.$datetime[1];
}
function getBln($bln) {
    $sls = $_GET['thakhir'] - $_GET['thawal'];
    for ($i = 0; $i <= $sls; $i++) {
        switch ($bln) {
            case 1 + (12 * $i):
                $val = "01";
                break;

            case 2 + (12 * $i):
                $val = "02";
                break;

            case 3 + (12 * $i):
                $val = "03";
                break;

            case 4 + (12 * $i):
                $val = "04";
                break;

            case 5 + (12 * $i):
                $val = "05";
                break;

            case 6 + (12 * $i):
                $val = "06";
                break;

            case 7 + (12 * $i):
                $val = "07";
                break;

            case 8 + (12 * $i):
                $val = "08";
                break;

            case 9 + (12 * $i):
                $val = "09";
                break;

            case 10 + (12 * $i):
                $val = "10";
                break;

            case 11 + (12 * $i):
                $val = "11";
                break;

            case 12 + (12 * $i):
                $val = "12";
                break;
        }
    }
    return $val;
}

function blnAngka($bln) {
    $val = "0";
    switch ($bln) {
        case "Januari":
            $val = "1";
            break;

        case "Februari":
            $val = "2";
            break;

        case "Maret":
            $val = "3";
            break;

        case "April":
            $val = "4";
            break;

        case "Mei":
            $val = "5";
            break;

        case "Juni":
            $val = "6";
            break;

        case "Juli":
            $val = "7";
            break;

        case "Agustus":
            $val = "8";
            break;

        case "September":
            $val = "9";
            break;

        case "Oktober":
            $val = "10";
            break;

        case "November":
            $val = "11";
            break;

        case "Desember":
            $val = "12";
            break;
    }
    return $val;
}
function pagination($sql, $dataPerPage, $tab = NULL){
             
    $showPage = NULL;
    ob_start();
    echo "
        <div class='pagination pagination-centered'><ul>";
    if (!empty($_GET['pages'])) {
        $noPage = $_GET['pages'];
    } else {
        $noPage = 1;
    }

    $dataPerPage = $dataPerPage;
    $offset = ($noPage - 1) * $dataPerPage;

    $hasil = mysql_query($sql);

    $data = mysql_num_rows($hasil);
    $jumData = $data;
    $jumPage = ceil($jumData / $dataPerPage);
    $get=$_GET;
    if ($jumData > $dataPerPage) {
        if ($noPage > 1){            
            $get['pages']=($noPage - 1);
            echo "<li><a class='page-prev' href='?" .  generate_get_parameter($get). "'> Prev </a></li>";
        }
        for ($page = 1; $page <= $jumPage; $page++) {
            if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) {
                if (($showPage == 1) && ($page != 2))
                    echo "...";
                if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
                    echo "...";
                if ($page == $noPage)
                    echo " <li class='active'><a href=#>" . $page . "</a></li> ";
                else{
                    $get['pages']=$page;
                    
                    if($tab != NULL){
                        $get['tab'] = $tab;
                    }
                    
                    echo "<li> <a class='block' href='?" .  generate_get_parameter($get). "'>" . $page . "</a> </li>";
                }
                $showPage = $page;
            }
        }

        if ($noPage < $jumPage){
            $get['pages']=($noPage + 1);
            echo "<li><a class='page-next' href='?" .  generate_get_parameter($get). "'> Next </a></li>";
        }
    }
    echo "</ul></div>";

    $buffer = ob_get_contents();
    ob_end_clean();
    return $buffer;
}
function redirect($uri = '', $method = 'location', $http_response_code = 302) {
    if (!preg_match('#^https?://#i', $uri)) {
        $uri = app_base_url($uri);
    }
//    echo'<script type="text/javascript">location.href="' . $uri . '"</script>';
		switch($method)
		{
			case 'refresh'	: header("Refresh:0;url=".$uri);
				break;
			default			: header("Location: ".$uri, TRUE, $http_response_code);
				break;
		}
    exit;
}

function show_array($array=array()){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function _select_arr($sql,$is_write_sql=false) {
    if($is_write_sql)
        echo $sql.'<br>';
    $result = array();
    $exe = mysql_query($sql) or die(mysql_error() . "<hr>" . $sql);
    while ($row = mysql_fetch_array($exe)) {
        $result[] = $row;
    }
    return $result;
}
function _select_max_id($table,$column='id'){
    $a=  _select_unique_result("select max($column) as max from $table");
//    echo "select max($column) as max from $table";
    return $a['max'];
}

function _query($sql,$is_write_sql=false) {
    if($is_write_sql)
        echo $sql.'<br>';
    $exe = mysql_query($sql) or die(mysql_error() . "<hr>" . $sql);
    return $exe;
}

function _select_unique_result($sql,$is_write_sql=false) {
    if($is_write_sql)
        echo $sql.'<br>';
    $exe = mysql_query($sql) or die(mysql_error() . "<hr>" . $sql);
    $row = mysql_fetch_array($exe);
    return $row;
}
function _insert($table_name,$data=array()){
    if(count($data)==0){
        echo "data kosong";exit;
    }
        
    $insertString="insert into $table_name ";
    $column="";
    $values="";
    foreach($data as $key=>$d){
        if($column==""){
            $column.="(";
            $values.="(";
        }else{
            $column.=",";
            $values.=",";
        }
        $column.="`$key`";
        if(is_array($d)){
            $values.=($d[1])?"'$d'":"$d[0]";
        }else{
            if($d==null)
                $values.="NULL";
            else
                $values.="'$d'";
        }
            
    }
    $column.=")";
        $values.=")";
    $query=$insertString.' '.$column.' values '.$values;
    $qry=mysql_query($query) or die (mysql_error().'<br/>'.$query);
    return true;;
}
function _update($table_name,$data,$where){
    if(count($data)==0){
        echo "data kosong";exit;
    }
        
    $insertString="update $table_name set ";
    $column="";
    foreach($data as $key=>$d){
        if($column!=""){
            $column.=",";
        }
        $column.="`$key`='$d'";
       
    }
    $query=$insertString.' '.$column.' where '.$where;
//    echo $query;exit;
    $qry=mysql_query($query) or die (mysql_error().'<br/>'.$query);
    return $qry;
}
function generate_get_parameter($get,$addArr=array(),$removeArr=array()) {
    if($addArr==null)
        $addArr=array();
    foreach($removeArr as $rm){
        unset($get[$rm]);
    }
    $link = "";
    $get=array_merge($get, $addArr);
    foreach ($get as $key => $val) {
        if ($link == null) {
            $link.="$key=$val";
        }else
            $link.="&$key=$val";
    }
    return $link;
}
function array_value($array, $index, $default=null) {
    if (isset($array[$index])) {
        return $array[$index];
    } else {
        if($index=='pages'){
//            return $default-1;
        }
        return $default;
    }
}
/**
 * 
 * @param type $tglLahir format y-m-d
 * @param type $tanggalSekarang format y-m-d
 * @return type
 */
function hitung_umur($tglLahir,$tanggalSekarang=null,$satuan=null){
    $tgl=$tglLahir;
    $tanggal = explode("-", $tgl);
    $tahun = $tanggal[0];
    $bulan = $tanggal[1];
    $hari = $tanggal[2];
    if($tanggalSekarang==null){
        $day = date('d');
        $month = date('m');
        $year = date('Y');
    }else{
        $tanggal = explode("-", $tanggalSekarang);
        $year = $tanggal[0];
        $month = $tanggal[1];
        $day = $tanggal[2];
    }
    $tahun = $year-$tahun;
    $bulan = $month-$bulan;
    $hari = $day-$hari;
    
    $jumlahHari = 0;
    $bulanTemp = ($month==1)?12:$month-1;
    if($bulanTemp==1 || $bulanTemp==3 || $bulanTemp==5 || $bulanTemp==7 || $bulanTemp==8 || $bulanTemp==10 || $bulanTemp==12){
        $jumlahHari=31;
    }else if($bulanTemp==2){
        if($tahun % 4==0)
            $jumlahHari=29;
        else
            $jumlahHari=28;
    }else{
        $jumlahHari=30;
    }
    
    if($hari<=0){
        $hari+=$jumlahHari;
        $bulan--;
    }
    if($bulan<0 || ($bulan==0 && $tahun!=0)){
        $bulan+=12;
        $tahun--;
    }
    if ($tahun =='0'){
	$tahunz='';
	}
	else{
	$tahunz=$tahun." Tahun ";
	}
    if($satuan=='tahun') return $tahun;
    if($satuan=='bulan') return $tahun*12+$bulan;
    return $tahunz.$bulan." Bulan ".$hari." Hari";
}
function getPerPage(){
    return 20;
}
function split_content(){
    echo '</div>
                            </div>
                            <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div>
                                <div class="Article">';
}

function is_login(){
    return isset($_SESSION['id_user']);
}
function get_user_login($id=null){
    if($id==null){
        if(isset($_SESSION['id_user']))
            $id=$_SESSION['id_user'];
        else return null;
    }
    
    if(is_admin() || is_operator()){
        $user= _select_unique_result("select * from admin where id='$id'");
    }else{
        $user= _select_unique_result("select * from member 
            join pengunjung on pengunjung.id=member.id_pengunjung
            where id_pengunjung='$id'");
    }
//    show_array($user);
    return $user;
}

function is_admin(){
    return ($_SESSION['status_user']=='admin');
}
function is_operator(){
    return ($_SESSION['status_user']=='operator');
}
function is_member(){
    return ($_SESSION['status_user']=='member');
}


function get_artikel_menu(){
    $groupList=  _select_arr("select * from kategori where kategori.id in 
        (select id_kategori from artikel where artikel.is_published=1 and artikel.id_kategori=kategori.id)");
    $artikelArr=array();
    $id=1;
    foreach ($groupList as $group){
        $artikelArr[$id]['title']=$group['nama'];
        $artikelList=  _select_arr("select * from artikel where id_kategori='$group[id]' and is_published=1");
        foreach($artikelList as $artikel){
            $artikelArr[$id]['menu'][]=array('url'=>'artikel/detail?id='.$artikel['id'],'title'=>$artikel['judul']);
        }
        $id++;
    }
    return $artikelArr;
}
function getMenuAdmin(){
    if(is_admin())
        return array(
            array('title'=>'History Kunjungan','url'=>'history_kunjungan'),
            array('title'=>'History Perpengunjung','url'=>'history_kunjungan_perpengunjung'),
            array('title'=>'Rating Kamar','url'=>'rating_kamar'),
            array('title'=>'Laporan Reservasi Per Kamar','url'=>'laporan_kamar'),
            array('title'=>'Admin','url'=>'admin'),
            array('title'=>'Operator','url'=>'operator'),
            array('title'=>'Kategori Fasilitas','url'=>'kategori_fasilitas'),
            array('title'=>'Fasilitas','url'=>'fasilitas'),
            array('title'=>'Kelas','url'=>'kelas'),
            array('title'=>'Kamar','url'=>'kamar'),
            array('title'=>'Pengunjung','url'=>'pengunjung'),
            array('title'=>'Bank','url'=>'bank'),
            array('title'=>'Kategori Artikel','url'=>'kategori_artikel'),
            array('title'=>'Artikel','url'=>'artikel'),
            array('title'=>'Kirim Promo','url'=>'promo_fasilitas'),
            array('title'=>'Setting','url'=>'setting'),
            array('title'=>'Logout','url'=>'login/logout'),
        );
    else if(is_operator()){
        return array(
            array('title'=>'Reservasi','url'=>''),
            array('title'=>'Pengunjung','url'=>'pengunjung'),
            array('title'=>'Rating Kamar','url'=>'rating_kamar'),
            array('title'=>'Laporan Reservasi Per Kamar','url'=>'laporan_kamar'),
//            array('title'=>'Pembayaran','url'=>'pembayaran'),
            array('title'=>'Logout','url'=>'../pageadmin/login/logout'),
        );
    }
}
function cekAdmin(){
    return TRUE;
}
function rupiah($nominal,$withRp=true){
        $rupiah = number_format($nominal, 0, ",", ".");
        if($withRp)
            $rupiah = "Rp " . $rupiah . ",-";
        return $rupiah;
}
function get_user_menu(){
    $artikelGroup=  _select_arr("select * from kategori_artikel where id>1");
    $artikelGroupLink=array();
    foreach ($artikelGroup as $group){
        $artikelGroupLink[]=array('title'=>$group['nama'],'url'=>'artikel?group='.$group['id'],'icon'=>'');
    }
    return array(
      array('title'=>'','url'=>'','icon'=>'icon-home'),  
      array('title'=>'Kamar','url'=>'kamar','icon'=>''),  
      array('title'=>'Fasilitas','url'=>'fasilitas','icon'=>''),  
      array('title'=>'Cara Pemesanan','url'=>'artikel/detail?id=1','icon'=>''),  
      array('title'=>'About Us','url'=>'artikel/detail?id=2','icon'=>''),  
      array('title'=>'Artikel','url'=>'artikel','icon'=>'','submenu'=>$artikelGroupLink),  
        
    );
}
function get_tanda_pengenal_list(){
    return array(
      'KTP','SIM','PASPOR','KTM','Kartu Pelajar'  
    );
}
/**
 * 
 * @param type $tglAwal d-m-y
 * @param type $tglAkhir d-m-y
 * @param type $jamAwal j:m:d
 * @param type $jamAkhir j:m:d
 * @return type integer jumlah jam
 */
function selisihJam($tglAwal, $tglAkhir,$jamAwal='00:00',$jamAkhir='00:00')
{
    // memecah string tanggal awal untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah1 = explode("-", $tglAwal);
    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];

    // memecah string tanggal akhir untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah2 = explode("-", $tglAkhir);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 =  $pecah2[0];

    $jamAwalPecah=  explode(':', $jamAwal);
    $jamAkhirPecah=  explode(':', $jamAkhir);
    
    // mencari selisih hari dari tanggal awal dan akhir
    $jd1 = mktime($jamAwalPecah[0],$jamAwalPecah[1],0,$month1, $date1, $year1);
    $jd2 = mktime($jamAkhirPecah[0],$jamAkhirPecah[1],0,$month2, $date2, $year2);
    $selisih = $jd2 - $jd1;
    // menghitung selisih hari yang bukan tanggal merah dan hari minggu
    return $selisih/3600;
}
function generate_sort_parameter($sort,$sortBy=null,$tab = NULL){
    $link=$_GET;
    $link['sort']=$sort;

    if($sortBy=='asc' && $_GET['sort']==$sort)
        $link['sortBy']='desc';
    else
        $link['sortBy']='asc';
    if($tab != NULL){
        $tabs['tab']=$tab;
    }else $tabs['tab']="";
    
    $link=generate_get_parameter($link,$tabs);
    return $link;
}
?>
