<?php
/**
 * Short description for categories_controller.php
 *
 * Long description for categories_controller.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2009, Rifaila.com
 *
 * Licensed under tbd
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Rifalia.es
 * @link          www.rifalia.es
 * @package       rifalia
 * @subpackage    rifalia.controllers
 * @since         v 1.0 (14-Jun-2009)
 * @license       tbd
 */

/**
 * CategoriesController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class CategoriesController extends AppController {

/**
 * name property
 *
 * @var string 'Categories'
 * @access public
 */
	var $name = 'Categories';

/**
 * paginate property
 *
 * @var array
 * @access public
 */
	var $paginate = array(
		'Category' => array(
		),
	);

/**
 * Called after the controller action is run and rendered.
 *
 * @access public
 * @link http://book.cakephp.org/view/60/Callbacks
 */
	function afterFilter() {
		parent::afterFilter();
	}

/**
 * Called before the controller action.
 *
 * @access public
 * @link http://book.cakephp.org/view/60/Callbacks
 */
	function beforeFilter() {
		parent::beforeFilter();
	}

/**
 * Called after the controller action is run, but before the view is rendered.
 *
 * @access public
 * @link http://book.cakephp.org/view/60/Callbacks
 */
	function beforeRender() {
		parent::beforeRender();
	}

/**
 * admin_add method
 *
 * @return void
 * @access public
 */
	function admin_add() {
		if ($this->data) {
			if ($this->Category->saveAll($this->data)) {
				$display = $this->Category->display();
				$this->Session->setFlash(sprintf(__('Category "%1$s" added', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Category->data;
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Category->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('errors in form', true));
				}
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
		$this->Category->id = $id;
		if ($id && $this->Category->exists()) {
			$display = $this->Category->display($id);
			if ($this->Category->del($id)) {
				$this->Session->setFlash(sprintf(__('Category %1$s "%2$s" deleted', true), $id, $display));
			} else {
				$this->Session->setFlash(sprintf(__('Problem deleting Category %1$s "%2$s"', true), $id, $display));
			}
		} else {
			$this->Session->setFlash(sprintf(__('Category with id %1$s doesn\'t exist', true), $id));
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
			if ($this->Category->saveAll($this->data)) {
				$display = $this->Category->display();
				$this->Session->setFlash(sprintf(__('Category "%1$s" updated', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Category->data;
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Category->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('errors in form', true));
				}
			}
		} elseif ($id) {
			$this->data = $this->Category->read(null, $id);
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
	function admin_index($id = null, $showAll = true) {
		$this->helpers[] = 'Tree';
		$order = 'Category.lft';
		if ($showAll) {
			if (!$id) {
				$conditions = array();
			} else {
				$row = $this->Category->read(null, $id);
				extract($row['Category']);
				$conditions = array('OR' => array(
					array(
						'Category.lft <=' => $lft,
						'Category.rght >=' => $rght,
					),
					'OR' => array(
						'Category.parent_id' => array($id, $parent_id),
						'Category.parent_id IS NULL',
					)
				));
			}
		} else {
			$conditions['Category.parent_id'] = null;
		}
		$this->data = $this->Category->find('all', compact('conditions', 'order', 'fields', 'recursive'));
	}

/**
 * admin_lookup method
 *
 * @param string $input ''
 * @return void
 * @access public
 */
	function admin_lookup($input = '') {
		$this->autoRender = false;
		if (!$input) {
			$input = $this->params['url']['q'];
		}
		if (!$input) {
			$this->output = '0';
			return;
		}
		$conditions = array(
			'id LIKE' => $input . '%',
			'name LIKE' => $input . '%',
		);
		if (!$this->data = $this->Category->find('list', compact('conditions'))) {
			$this->output = '0';
			return;
		}
		return $this->render('/elements/lookup_results');
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
			if ($this->Category->saveAll($data, array('validate' => 'first', 'atomic' => false))) {
				$this->Session->setFlash(sprintf(__('Categories added', true)));
				$this->_back();
			} else {
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Category->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('Some or all additions did not succeed', true));
				}
			}
		} else {
			$this->data = array('1' => array('Category' => $this->Category->create()));
			$this->data[1]['Category']['id'] = null;
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
			if ($this->Category->saveAll($data, array('validate' => 'first'))) {
				$this->Session->setFlash(sprintf(__('Categories updated', true)));
			} else {
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Category->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('Some or all updates did not succeed', true));
				}
			}
			$this->_setSelects();
		} else {
			$args = func_get_args();
			call_user_func_array(array($this, 'admin_index'), $args);
			array_unshift($this->data, 'dummy');
			unset($this->data[0]);
			$this->_setSelects();
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
			$term = trim($this->data['Category']['query']);
			$url = array(urlencode($term));
			if ($this->data['Category']['extended']) {
				$url['extended'] = true;
			}
			$this->redirect($url);
		}
		$request = $_SERVER['REQUEST_URI'];
		$term = trim(str_replace(Router::url(array()), '', $request), '/');
		if (!$term) {
			$this->redirect(array('action' => 'index'));
		}
		$conditions = $this->Category->searchConditions($term, isset($this->passedArgs['extended']));
		$this->Session->setFlash(sprintf(__('All categories matching the term "%1$s"', true), htmlspecialchars($term)));
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
		$this->data = $this->Category->read(null, $id);
		if(!$this->data) {
			$this->Session->setFlash(__('Invalid category', true));
			return $this->_back();
		}
	}

/**
 * isAuthorized method
 *
 * @return void
 * @access public
 */
	function isAuthorized() {
		return parent::isAuthorized();
	}

/**
 * setSelects method
 *
 * @return void
 * @access protected
 */
	function _setSelects() {
		$sets['parents'] = $this->Category->generateTreeList();
		$sets['products'] = $this->Category->Product->find('list');
		$this->set($sets);
	}
}