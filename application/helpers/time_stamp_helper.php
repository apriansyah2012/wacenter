<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//format nomor ditambah angka nol didepan
if ( ! function_exists('time_stamp'))
{
		   function timeInSentence($val, $lang = 'id', $word = 0, $x = 0, $res = array()) {

		  $y = array(31536000, 2592000, 604800, 86400, 3600, 60, 1);
		  $l['id'] = array('tahun', 'bulan', 'minggu', 'hari', 'jam', 'menit', 'detik');
		  $l['en'] = array('year', 'month', 'week', 'day', 'hour', 'minute', 'second');

		  $end['id'] = 'yang lalu';
		  $end['en'] = 'ago';

		  while($x < count($y)) {

			$a = $val % $y[$x];
			if($a != 0) {
			  $res[$l[$lang][$x]] = floor($val/$y[$x]);
			  $val = $a;
			}
			else {
			   $res[$l[$lang][$x]] = $val/$y[$x];
			   $val = 0;
			}

			return timeInSentence( $val, $lang, $word, $x + 1, $res);
		  }
		  $hasil = '';
		  if($word == 0)
			$word = count($l[$lang]-1);
		  if($lang == 'id')
			$hasil = '';//sekitar diganti kosong
		  if($lang == 'en')
			$hasil = ' ';//about diganti kosong
		  $i = 0;
		  foreach($res as $k => $v) {
			if($v > 0) {
			  if($i == $word)
				break;

			  $res2[$k] = $v;
			  $key[$i] = $k;
			  $i++;
			}
		  }
		  $bates = count($res2);
		  for($i=0;$i<$bates;$i++) {
			$angka = $res2[$key[$i]];
			$kata = $key[$i];

			if($lang == 'en' && $angka > 1)
			  $kata .= 's';

			if($i+1 == $bates && $word != 1) {
			  if($lang == 'en')
				$angka = ','.$angka;//and diganti koma

			  if($lang == 'id')
				$angka = ','.$angka;//dan diganti koma
			}
			$hasil .= $angka.' '.$kata.' ';
		  }
		  return trim($hasil.$end[$lang]);
		}
}

	
