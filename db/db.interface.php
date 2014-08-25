<?php

/*
 * nosqlPHP v1.0
 * http://www.nosqlphp.com/
 *
 * Copyright 2015 (c) info@fromsoft.org
 * GNU LESSER GENERAL PUBLIC LICENSE Version 3
 * http://www.gnu.org/licenses/lgpl.html
 *
 */

if(!defined('FRAMEWORK_PATH')) {
	exit('FRAMEWORK_PATH not defined.');
}

interface db_interface {

	public function __construct($conf);

	public function get($key);
	
	public function set($key, $data);
	
	public function update($key, $arr);

	public function delete($key);

	public function maxid($table, $val = 0);
	
	public function count($table, $val = 0);

	public function truncate($table);
	
	public function version();
	
	public function index_fetch($table, $keyname, $cond = array(), $orderby = array(), $start = 0, $limit = 0);
	
	public function index_fetch_id($table, $keyname, $cond = array(), $orderby = array(), $start = 0, $limit = 0);
	
	public function index_update($table, $cond, $update, $lowprority = FALSE);
	
	public function index_delete($table, $cond, $lowprority = FALSE);
		
	public function index_maxid($key);
	
	public function index_count($table, $cond = array());
	
	public function index_create($table, $index);
	
	public function index_drop($table, $index);
	
	public function table_create($table, $cols, $engineer = '');
	
	public function table_drop($table);
	
}

/*
	$nodbconf = array(
		'master' => array (
				'host' => '127.0.0.1:27017',
				'user' => '',
				'password' => '',
				'name' => 'test',
				'tablepre' => '',
		),
		'slaves' => array (
		)
	);
	
	$nodb = new db_mongodb($nodbconf);
	
	$user = $nodb->get("user-uid-$uid");
	
	$uid = $nodb->maxid('user-uid', '+1');
	$nodb->set("user-uid-$uid", array('username'=>'admin', 'email'=>'xxx@xxx.com'));
	
	$nodb->set("user-uid-$uid", array('username'=>'admin', 'email'=>'xxx@xxx.com'));
	
	$nodb->delete("user-uid-$uid");
	
	$userlist = $nodb->index_fetch('user', 'uid', array('groupid' => 1), array(), 0, 10);
	$userlist = $nodb->index_fetch('user', 'uid', array('uid' => array('>', 123)), array(), 0, 10);
	
	$nodb->count('user');
	
*/

?>
