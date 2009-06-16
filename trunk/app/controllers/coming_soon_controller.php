<?php
class ComingSoonController extends AppController {
	var $uses = array();
	var $components = array('Security');
	function beforeFilter() {
		$this->Auth->allow('index');
		$this->Auth->allow('register');
	}
	function index() {
	}
}