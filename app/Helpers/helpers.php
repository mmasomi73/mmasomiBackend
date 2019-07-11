<?php

use App\Utilities\MP3File;

if (!function_exists('mp3Duration')) {

	function mp3Duration($src)
	{
		$mp3file = new MP3File($src);
		$du = $mp3file->getDurationEstimate();//(faster) for CBR only
		return MP3File::formatTime($du);

	}
}
function getPostTime($date){
	if (strtotime($date))
		return \Carbon\Carbon::parse ($date)->format ('H:i');
	return '-';
}
function getPostDate($date){
	if (strtotime($date)){
		$c = \Carbon\Carbon::parse ($date);
		return $c->format ('y/m/d');
	}

	return '-';
}