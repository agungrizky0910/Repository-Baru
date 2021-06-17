<?php
function full_date($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB')
{

	if (trim($timestamp) == '') {
		$timestamp = time();
	} elseif (!ctype_digit($timestamp)) {
		$timestamp = strtotime($timestamp);
	}

	# remove S (st,nd,rd,th) there are no such things in indonesia :p

	$date_format = preg_replace("/S/", "", $date_format);

	$pattern = array(
		'/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
		'/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
		'/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
		'/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
		'/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
		'/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
		'/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
		'/November/', '/December/',
	);

	$replace = array(
		'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
		'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
		'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
		'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'Sepember',
		'Oktober', 'November', 'Desember',
	);

	$date = date($date_format, $timestamp);
	$date = preg_replace($pattern, $replace, $date);
	$date = "{$date} {$suffix}";
	return $date;
}

function encode($id)
{
	$id_str = (string) $id;
	$offset = rand(0, 9);
	$encoded = chr(79 + $offset);
	for ($i = 0, $len = strlen($id_str); $i < $len; ++$i) {
		$encoded .= chr(65 + $id_str[$i] + $offset);
	}
	return $encoded;
}

function decode($encoded)
{
	$offset = ord($encoded[0]) - 79;
	$encoded = substr($encoded, 1);
	for ($i = 0, $len = strlen($encoded); $i < $len; ++$i) {
		$encoded[$i] = ord($encoded[$i]) - $offset - 65;
	}
	return (int) $encoded;
}

function short_date($timestamp = '', $date_format = 'j F Y')
{

	if (trim($timestamp) == '') {
		$timestamp = time();
	} elseif (!ctype_digit($timestamp)) {
		$timestamp = strtotime($timestamp);
	}

	# remove S (st,nd,rd,th) there are no such things in indonesia :p

	$date_format = preg_replace("/S/", "", $date_format);

	$pattern = array(
		'/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
		'/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
		'/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
		'/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
		'/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
		'/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
		'/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
		'/November/', '/December/',
	);

	$replace = array(
		'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
		'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
		'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
		'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'Sepember',
		'Oktober', 'November', 'Desember',
	);

	$date = date($date_format, $timestamp);
	$date = preg_replace($pattern, $replace, $date);
	$date = "{$date}";
	return $date;
}

function periode($timestamp = '', $date_format = 'F Y')
{

	if (trim($timestamp) == '') {
		$timestamp = time();
	} elseif (!ctype_digit($timestamp)) {
		$timestamp = strtotime($timestamp);
	}

	# remove S (st,nd,rd,th) there are no such things in indonesia :p

	$date_format = preg_replace("/S/", "", $date_format);

	$pattern = array(
		'/Mon[^day]/', '/Tue[^sday]/', '/Wed[^nesday]/', '/Thu[^rsday]/',
		'/Fri[^day]/', '/Sat[^urday]/', '/Sun[^day]/', '/Monday/', '/Tuesday/',
		'/Wednesday/', '/Thursday/', '/Friday/', '/Saturday/', '/Sunday/',
		'/Jan[^uary]/', '/Feb[^ruary]/', '/Mar[^ch]/', '/Apr[^il]/', '/May/',
		'/Jun[^e]/', '/Jul[^y]/', '/Aug[^ust]/', '/Sep[^tember]/', '/Oct[^ober]/',
		'/Nov[^ember]/', '/Dec[^ember]/', '/January/', '/February/', '/March/',
		'/April/', '/June/', '/July/', '/August/', '/September/', '/October/',
		'/November/', '/December/',
	);

	$replace = array(
		'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min',
		'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu',
		'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des',
		'Januari', 'Februari', 'Maret', 'April', 'Juni', 'Juli', 'Agustus', 'Sepember',
		'Oktober', 'November', 'Desember',
	);

	$date = date($date_format, $timestamp);
	$date = preg_replace($pattern, $replace, $date);
	$date = "{$date}";
	return $date;
}


function telepon($string)
{
	$string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
	return preg_replace('/[^0-9]/', '', $string); // Removes special chars.
}

function wordlimit($text, $limit = 30)
{
	if (strlen($text) > $limit)
		$word = mb_substr($text, 0, $limit - 3) . "..";
	else
		$word = $text;
	return $word;
}

function custome_wordlimit($text, $limit)
{
	if (strlen($text) > $limit)
		$word = mb_substr($text, 0, $limit - 3) . "..";
	else
		$word = $text;
	return $word;
}

function waktu_lalu($waktu_masuk)
{
	date_default_timezone_set('Asia/Jakarta');
	$selisih = time() - strtotime($waktu_masuk);

	$detik = $selisih;
	$menit = round($selisih / 60);
	$jam = round($selisih / 3600);
	$hari = round($selisih / 86400);
	$minggu = round($selisih / 604800);
	$bulan = round($selisih / 2419200);
	$tahun = round($selisih / 29030400);

	if ($detik <= 60) {
		$waktu = $detik . ' detik';
	} else if ($menit <= 60) {
		$waktu = $menit . ' menit';
	} else if ($jam <= 24) {
		$waktu = $jam . ' jam';
	} else if ($hari <= 7) {
		$waktu = short_date($waktu_masuk);
	} else if ($minggu <= 4) {
		$waktu = short_date($waktu_masuk);
	} else if ($bulan <= 12) {
		$waktu = short_date($waktu_masuk);
	} else {
		$waktu = short_date($waktu_masuk);
	}

	return $waktu;
}

function countDays($year, $month, $ignore)
{
	$count = 0;
	$counter = mktime(0, 0, 0, $month, 1, $year);
	while (date("n", $counter) == $month) {
		if (in_array(date("w", $counter), $ignore) == false) {
			$count++;
		}
		$counter = strtotime("+1 day", $counter);
	}
	return $count;
}
