<?php

if (!defined('QUICKSILVERFORUMS')) {
	header('HTTP/1.0 403 Forbidden');
	die;
}

$set = array();
$set['db_host'] = 'localhost';
$set['db_name'] = 'DB_NAME';
$set['db_pass'] = 'DB_PASS';
$set['db_port'] = '';
$set['db_socket'] = '';
$set['db_user'] = 'DB_USER';
$set['dbtype'] = 'mysql';
$set['installed'] = '0';
$set['prefix'] = 'qsfp_';
$set['admin_email'] = '';
?>
