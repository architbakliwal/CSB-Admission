<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('doHTML'))
{
    function doHTML($string) {
    
    	$string = str_replace("<", "&lt;", $string);
    	$string = str_replace(">", "&gt;", $string);
    
    	return $string;
       
    }   
}