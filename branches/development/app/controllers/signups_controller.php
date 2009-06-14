<?php
/* SVN FILE: $Id$ */

/**
 * Short description for signups_controller.php
 *
 * Long description for signups_controller.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2009, Andy Dawson
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Rifalia.com
 * @link          www.rifalia.com
 * @package       rifalia
 * @subpackage    rifalia.controllers
 * @since         v 1.0 (07-Jun-2009)
 * @license       tbd
 */

/**
 * SignupsController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class SignupsController extends AppController {

/**
 * name property
 *
 * @var string 'Signups'
 * @access public
 */
	var $name = 'Signups';

/**
 * paginate property
 *
 * @var array
 * @access public
 */
	var $paginate = array(
		'Signup' => array(
		),
	);
	//var $components = array('Security');
	function beforeFilter() {
		$this->Auth->allow('add');
		//$this->Security->blackHoleCallback = '_blackHole';
		parent::beforeFilter();
	}

/**
 * admin_add method
 *
 * @return void
 * @access public
 */
	function admin_add() {
		if ($this->data) {
			if ($this->Signup->saveAll($this->data)) {
				$display = $this->Signup->display();
				$this->Session->setFlash(sprintf(__('Signup "%1$s" added', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Signup->data;
				$this->Session->setFlash(__('errors in form', true));
			}
		}
		$this->_setSelects();
		$this->render('admin_edit');
	}

/**
 * admin_delete method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	function admin_delete($id = null) {
		$this->Signup->id = $id;
		if ($id && $this->Signup->exists()) {
			$display = $this->Signup->display($id);
			if ($this->Signup->del($id)) {
				$this->Session->setFlash(sprintf(__('Signup %1$s "%2$s" deleted', true), $id, $display));
			} else {
				$this->Session->setFlash(sprintf(__('Problem deleting Signup %1$s "%2$s"', true), $id, $display));
			}
		} else {
			$this->Session->setFlash(sprintf(__('Signup with id %1$s doesn\'t exist', true), $id));
		}
		return $this->_back();
	}

/**
 * admin_edit method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	function admin_edit($id = null) {
		if ($this->data) {
			if ($this->Signup->saveAll($this->data)) {
				$display = $this->Signup->display();
				$this->Session->setFlash(sprintf(__('Signup "%1$s" updated', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Signup->data;
				$this->Session->setFlash(__('errors in form', true));
			}
		} elseif ($id) {
			$this->data = $this->Signup->read(null, $id);
		} else {
			return $this->_back();
		}
		$this->_setSelects();
	}

/**
 * admin_index method
 *
 * @return void
 * @access public
 */
	function admin_index() {
		if (isset($this->SwissArmy)) {
			$conditions = $this->SwissArmy->parseSearchFilter();
		} else {
			$conditions = array();
		}
		if ($conditions) {
			$this->set('filters', $this->Signup->searchFilterFields());
			$this->set('addFilter', true);
		}
		$this->data = $this->paginate($conditions);
		$this->_setSelects();
	}

/**
 * admin_multi_add method
 *
 * @return void
 * @access public
 */
	function admin_multi_add() {
		if ($this->data) {
			$data = array();
			foreach ($this->data as $key => $row) {
				if (!is_numeric($key)) {
					continue;
				}
				$data[$key] = $row;
			}
			if ($this->Signup->saveAll($data, array('validate' => 'first', 'atomic' => false))) {
				$this->Session->setFlash(sprintf(__('Signups added', true)));
				$this->_back();
			} else {
				$this->Session->setFlash(__('Some or all additions did not succeed', true));
			}
		} else {
			$this->data = array(array('Signup' => $this->Signup->create()));
			$this->data[0]['Signup']['id'] = null;
		}
		$this->_setSelects();
		$this->render('admin_multi_edit');
	}

/**
 * admin_multi_edit method
 *
 * @return void
 * @access public
 */
	function admin_multi_edit() {
		if ($this->data) {
			$data = array();
			foreach ($this->data as $key => $row) {
				if (!is_numeric($key)) {
					continue;
				}
				$data[$key] = $row;
			}
			if ($this->Signup->saveAll($data, array('validate' => 'first'))) {
				$this->Session->setFlash(sprintf(__('Signups updated', true)));
			} else {
				$this->Session->setFlash(__('Some or all updates did not succeed', true));
			}
			$this->_setSelects();
		} else {
			$args = func_get_args();
			call_user_func_array(array($this, 'admin_index'), $args);
			array_unshift($this->data, 'dummy');
			unset($this->data[0]);
		}
	}

/**
 * admin_search method
 *
 * @param mixed $term null
 * @return void
 * @access public
 */
	function admin_search($term = null) {
		if ($this->data) {
			$term = trim($this->data['Signup']['query']);
			$url = array(urlencode($term));
			if ($this->data['Signup']['extended']) {
				$url['extended'] = true;
			}
			$this->redirect($url);
		}
		$request = $_SERVER['REQUEST_URI'];
		$term = trim(str_replace(Router::url(array()), '', $request), '/');
		if (!$term) {
			$this->redirect(array('action' => 'index'));
		}
		$conditions = $this->Signup->searchConditions($term, isset($this->passedArgs['extended']));
		$this->Session->setFlash(sprintf(__('All signups matching the term "%1$s"', true), htmlspecialchars($term)));
		$this->data = $this->paginate($conditions);
		$this->_setSelects();
		$this->render('admin_index');
	}

/**
 * admin_view method
 *
 * @return void
 * @access public
 */
	function admin_view() {
		$this->data = $this->Signup->read(null, $id);
		if(!$this->data) {
			$this->Session->setFlash(__('Invalid signup', true));
			return $this->_back();
		}
	}
	function add() {
		if ($this->data) {
			if ($this->Signup->save($this->data)) {
				$this->Session->setFlash('Gracias por tu interes');
				return $this->_back();
			} else {
				$this->data = $this->Signup->data;
				$this->Session->setFlash('Lo siento, intentalo de nuevo');
			}
		}
		$this->_setSelects();
		$this->render('admin_edit');
	}
	function _blackHole($reason) {
		$this->Session->setFlash('Lo siento, intentalo de nuevo 2');
		$this->_back();
	}
}