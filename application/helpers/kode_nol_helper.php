<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//format nomor ditambah angka nol didepan
if ( ! function_exists('kode_nol'))
{
    function kode_nol($MaksID)
    {
        if($MaksID < 10) $ID = "000".$MaksID; // nilai kurang dari 10
		else if($MaksID < 100) $ID = "00".$MaksID; // nilai kurang dari 100
		else if($MaksID < 1000) $ID = "0".$MaksID; // nilai kurang dari 1000
		else if($MaksID < 10000) $ID = "".$MaksID; // nilai kurang dari 10000
		else $ID = $MaksID;
        return $ID; //hasil akhir
    }
}

