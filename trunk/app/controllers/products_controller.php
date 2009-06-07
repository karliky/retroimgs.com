<?php

/**
 * Short description for products_controller.php
 *
 * Long description for products_controller.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2009, Rifaila.com
 *
 * Licensed under tbd
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Rifalia.com
 * @link          www.rifalia.com
 * @package       rifalia
 * @subpackage    rifalia.controllers
 * @since         v 1.0 (06-Jun-2009)
 * @license       tbd
 */

/**
 * ProductsController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class ProductsController extends AppController {

/**
 * name property
 *
 * @var string 'Products'
 * @access public
 */
	var $name = 'Products';
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('*'); // allow all actions for now (temporary)
	}

/**
 * index method
 *
 * @return void
 * @access public
 */
	function index() {
		if (isset($this->SwissArmy)) {
			$conditions = $this->SwissArmy->parseSearchFilter();
		} else {
			$conditions = array();
		}
		if ($conditions) {
			$this->set('filters', $this->Product->searchFilterFields());
			$this->set('addFilter', true);
		}
		$this->Product->recursive = 1;
		$this->data = $this->paginate($conditions);
		$this->_setSelects();
	}

/**
 * add method
 *
 * @return void
 * @access public
 */
	function add() {
		if ($this->data) {
			if ($this->Product->saveAll($this->data)) {
				$display = $this->Product->display();
				$this->Session->setFlash(sprintf(__('Product "%1$s" added', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Product->data;
				$this->Session->setFlash(__('errors in form', true));
			}
		}
		$this->_setSelects();
		$this->render('add');
	}

/**
 * delete method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
	function delete($id) {
		$this->Product->id = $id;
		if ($this->Product->exists()) {
			$display = $this->Product->display($id);
			if ($this->Product->del($id)) {
				$this->Session->setFlash(sprintf(__('Product %1$s "%2$s" deleted', true), $id, $display));
			} else {
				$this->Session->setFlash(sprintf(__('Problem deleting product %1$s "%2$s"', true), $id, $display));
			}
		} else {
			$this->Session->setFlash(sprintf(__('Product with id %2$s doesn\'t exist', true), $id));
		}
		return $this->_back();
	}

/**
 * edit method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
	function edit($id) {
		if ($this->data) {
			if ($this->Product->saveAll($this->data)) {
				$display = $this->Product->display();
				$this->Session->setFlash(sprintf(__('Product "%1$s" updated', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Product->data;
				$this->Session->setFlash(__('errors in form', true));
			}
		} else {
			$this->data = $this->Product->read(null, $id);
		}
		$this->_setSelects();
	}

/**
 * search method
 *
 * @param mixed $term null
 * @return void
 * @access public
 */
	function search($term = null) {
		if ($this->data) {
			$term = trim($this->data[$this->modelClass]['query']);
			$url = array(urlencode($term));
			$this->redirect($url);
		}
		$request = $_SERVER['REQUEST_URI'];
		$term = trim(str_replace(Router::url(array()), '', $request), '/');
		if (!$term) {
			$this->redirect(array('action' => 'index'));
		}
		$conditions = $this->Product->searchConditions($term, isset($this->passedArgs['extended']));
		$this->Session->setFlash(sprintf(__('All products matching the term "%1$s"', true), htmlspecialchars($term)));
		$this->data = $this->paginate($conditions);
		$this->_setSelects();
		$this->render('admin_index');
	}
}
?>