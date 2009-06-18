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
 * @copyright     Copyright (c) 2009, Rifalia.es
 * @link          www.rifalia.es
 * @package       rifalia
 * @subpackage    rifalia.controllers
 * @since         v 1.0 (14-Jun-2009)
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

/**
 * paginate property
 *
 * @var array
 * @access public
 */
	var $paginate = array(
		'Product' => array(
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
		if (!empty($this->data['MediaLink'])) {
			if (empty($this->data['MediaLink']['media_id']) && $this->data['Media']['filename']['error'] == 4) {
				unset ($this->data['MediaLink']);
				unset ($this->data['Media']);
			}
		}
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
			if ($this->Product->saveAll($this->data)) {
				$display = $this->Product->display();
				if ($this->Product->MediaLink->id) {
					$this->Product->MediaLink->saveField('model', 'Product');
					$this->Product->Media->saveField('description', $display);
				}
				$this->Session->setFlash(sprintf(__('Product "%1$s" added', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Product->data;
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Product->validationErrors, '<br />'));
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
		$this->Product->id = $id;
		if ($id && $this->Product->exists()) {
			$display = $this->Product->display($id);
			if ($this->Product->del($id)) {
				$this->Session->setFlash(sprintf(__('Product %1$s "%2$s" deleted', true), $id, $display));
			} else {
				$this->Session->setFlash(sprintf(__('Problem deleting Product %1$s "%2$s"', true), $id, $display));
			}
		} else {
			$this->Session->setFlash(sprintf(__('Product with id %1$s doesn\'t exist', true), $id));
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
			if ($this->Product->saveAll($this->data)) {
				$display = $this->Product->display();
				if ($this->Product->MediaLink->id) {
					$this->Product->MediaLink->saveField('model', 'Product');
					$this->Product->Media->saveField('description', $display);
				}
				$this->Session->setFlash(sprintf(__('Product "%1$s" updated', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Product->data;
				if (Configure::read()) {
					foreach ($this->Product->validationErrors as $field => &$val) {
						if (is_array($val)) {
							$val = implode($val, '<br />');
						}
					}
					$this->Session->setFlash(implode($this->Product->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('errors in form', true));
				}
			}
		} elseif ($id) {
			$this->data = $this->Product->read(null, $id);
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
			$this->set('filters', $this->Product->searchFilterFields());
			$this->set('addFilter', true);
		}
		$this->data = $this->paginate($conditions);
		$this->_setSelects();
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
		if (!$this->data = $this->Product->find('list', compact('conditions'))) {
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
			if ($this->Product->saveAll($data, array('validate' => 'first', 'atomic' => false))) {
				$this->Session->setFlash(sprintf(__('Products added', true)));
				$this->_back();
			} else {
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Product->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('Some or all additions did not succeed', true));
				}
			}
		} else {
			$this->data = array('1' => array('Product' => $this->Product->create()));
			$this->data[1]['Product']['id'] = null;
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
			if ($this->Product->saveAll($data, array('validate' => 'first'))) {
				$this->Session->setFlash(sprintf(__('Products updated', true)));
			} else {
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Product->validationErrors, '<br />'));
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
			$term = trim($this->data['Product']['query']);
			$url = array(urlencode($term));
			if ($this->data['Product']['extended']) {
				$url['extended'] = true;
			}
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

/**
 * admin_view method
 *
 * @return void
 * @access public
 */
	function admin_view() {
		$this->data = $this->Product->read(null, $id);
		if(!$this->data) {
			$this->Session->setFlash(__('Invalid product', true));
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
		$sets['raffles'] = $this->Product->Raffle->find('list');
		$sets['categories'] = $this->Product->Category->generateTreeList();
		$sets['providers'] = $this->Product->Provider->find('list');
		$this->set($sets);
	}
}