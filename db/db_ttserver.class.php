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

class db_ttserver implements db_interface {

	private $memcache;
	
	public function __construct($conf) {
		$this->conf = $conf;
	}
		
	public function __get($var) {
		if($var == 'memcache') {
			$this->memcache = new Memcache;
			if(!$this->memcache) {
				throw new Exception('PHP.ini Error: Memcache extension not loaded.');
			}
	 		if($this->memcache->connect($this->conf['host'], $this->conf['port'])) {
	 			return $this->memcache;
	 		} else {
	 			throw new Exception('Can not connect to Memcached host.');
	 		}
		}
	}

	
	public function set($key, $data, $life = 0) {
		$value = serialize($value); 
		return $this->memcache->set($key, $value, 0, $life);
	}

	public function get($key) {
		if(is_array($key)) {
			return $this->memcache->getMulti($key);
		}
		$data = $this->memcache->get($key);
		$data = unserialize($data); // ttserver
		return $data;
	}

	public function delete($key) {
		return $this->memcache->delete($key);
	}
	
	public function flush() {
		return $this->memcache->flush();
	}
	
	public function maxid($table, $val = 0) {
		if(!$val) {
			$key = $table.'-Auto_increment';
			return intval($this->get($key));
		} else {
			$key = $table.'-Auto_increment';
			$n = intval($this->get($key));
			$this->set($key, $n + $val);
			return $n + $val;
		}
	}
	
	public function count($table, $val = 0) {
		if($val) {
			$key = $table.'-Rows';
			return intval($this->get($key));
		} else {
			$key = $table.'-Rows';
			$n = intval($this->get($key));
			$this->set($key, $n + $val);
			return $n + $val;
		}
	}
	
	public function index_fetch($table, $keyname, $cond = array(), $orderby = array(), $start = 0, $limit = 10) {
		// todo
		return array();
	}

	public function index_create($table, $index) {
		// todo
		return FALSE;
	}
	
	public function index_drop($table, $index) {
		// todo
		return FALSE;
	}
	
	public function __destruct() {
		//$this->memcache->close();
	}

	public function version() {
		return '';// select version()
	}
}
