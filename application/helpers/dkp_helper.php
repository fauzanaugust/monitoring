<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function GET_TIMESTAMP() {
    
    $DATE_FORMAT = "%Y-%m-%d %H:%i:%s";
	$TIME        = time();
    return mdate($DATE_FORMAT, $TIME);
}

function CLEAN_TEXT($string) {
    
    return trim(strip_tags($string));
}
