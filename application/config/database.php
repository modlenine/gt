<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($_SERVER['HTTP_HOST'] == "localhost"){
	$mysqlServer = "217.21.74.1";
}else{
	$mysqlServer = "localhost";
}

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $mysqlServer,
	'username' => 'u438260853_gtprogram',
	'password' => 'Idkfa*999',
	'database' => 'u438260853_gtprogram',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);




