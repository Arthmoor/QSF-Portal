<?php

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

$set = array();
$set['db_host'] = 'localhost';
$set['db_name'] = '';
$set['db_pass'] = '';
$set['db_port'] = '3306';
$set['db_socket'] = '';
$set['db_user'] = '';
$set['dbtype'] = 'mysql';
$set['installed'] = '0';
$set['prefix'] = 'qsf_';
?>
