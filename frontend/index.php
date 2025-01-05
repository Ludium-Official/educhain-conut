<?php
include_once('common.php');
//if (!$member["mb_id"]) {goto_url("index.php");} 
$g5['title'] = 'index';
include_once('head.sub.php');
if ($member["mb_id"]) {goto_url("lobby.php");} else {goto_url("login.php");}

include_once('tail.sub.php');
?>
