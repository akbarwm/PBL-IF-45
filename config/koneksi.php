<?php
date_default_timezone_set("Asia/Jakarta");
$server 	= "localhost";
$username	= "root";
$pass		= "";
$db 		= "db_kelurahan"; //sesuaikan nama databasenya
$koneksi = mysqli_connect($server, $username, $pass, $db); //pastikan urutan pemanggilan variabel nya sama.

//untuk cek jika koneksi gagal ke database
if(mysqli_connect_errno()) {
	echo "Koneksi gagal : ".mysqli_connect_error();
}

function format_tanggal($waktu)
{
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($waktu));
    
    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun$hari, 
    return "$tanggal/$bl/$tahun";
}

function hitung_tanggal($waktu_a, $waktu_b)
{
	//hitung hari
$startTimeStamp = strtotime($waktu_a);
$endTimeStamp = strtotime($waktu_b);

$timeDiff = abs($endTimeStamp - $startTimeStamp);

$numberDays = $timeDiff/86400;  // 86400 seconds in one day

$numberDays = intval($numberDays);

//hitung bulan
	$year1 = date('Y', $endTimeStamp);
	$year2 = date('Y', $startTimeStamp);

	$month1 = date('m', $endTimeStamp);
	$month2 = date('m', $startTimeStamp);

	$diff = (($year2 - $year1) * 12) + ($month2 - $month1);


//hitung tahun
$sdate = $waktu_a;
$edate = $waktu_b;

$date_diff = abs(strtotime($edate) - strtotime($sdate));

$years = floor($date_diff / (365*60*60*24));
$months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));



if($numberDays < 30) {
	return "$numberDays Hari";
} elseif(($numberDays > 30) && ($diff <= 12)) {
	return "$diff Bulan";
} elseif($diff > 12) {
	printf("%d tahun, %d bulan, %d hari", $years, $months, $days);
	//printf("%d tahun, %d bulan", $years, $months);
}
}