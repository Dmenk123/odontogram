<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function clean_string($str){
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}
?>