<?php
/**
 * Short description for raffles_controller.php
 *
 * Long description for raffles_controller.php
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
 * @since         v 1.0 (07-Jun-2009)
 * @license       tbd
 */

/**
 * RafflesController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class RafflesController extends AppController {

/**
 * name property
 *
 * @var string 'Raffles'
 * @access public
 */
	var $name = 'Raffles';

/**
 * paginate property
 *
 * @var array
 * @access public
 */
	var $paginate = array(
		'Raffle' => array(
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
		$this->Auth->allow('home');
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
			if ($this->Raffle->saveAll($this->data)) {
				$display = $this->Raffle->display();
				$this->Session->setFlash(sprintf(__('Raffle "%1$s" added', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Raffle->data;
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Raffle->validationErrors, '<br />'));
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
		$this->Raffle->id = $id;
		if ($id && $this->Raffle->exists()) {
			$display = $this->Raffle->display($id);
			if ($this->Raffle->del($id)) {
				$this->Session->setFlash(sprintf(__('Raffle %1$s "%2$s" deleted', true), $id, $display));
			} else {
				$this->Session->setFlash(sprintf(__('Problem deleting Raffle %1$s "%2$s"', true), $id, $display));
			}
		} else {
			$this->Session->setFlash(sprintf(__('Raffle with id %1$s doesn\'t exist', true), $id));
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
			if ($this->Raffle->saveAll($this->data)) {
				$display = $this->Raffle->display();
				$this->Session->setFlash(sprintf(__('Raffle "%1$s" updated', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Raffle->data;
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Raffle->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('errors in form', true));
				}
			}
		} elseif ($id) {
			$this->data = $this->Raffle->read(null, $id);
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
			$this->set('filters', $this->Raffle->searchFilterFields());
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
		);
		if (!$this->data = $this->Raffle->find('list', compact('conditions'))) {
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
			if ($this->Raffle->saveAll($data, array('validate' => 'first', 'atomic' => false))) {
				$this->Session->setFlash(sprintf(__('Raffles added', true)));
				$this->_back();
			} else {
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Raffle->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('Some or all additions did not succeed', true));
				}
			}
		} else {
			$this->data = array('1' => array('Raffle' => $this->Raffle->create()));
			$this->data[1]['Raffle']['id'] = null;
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
			if ($this->Raffle->saveAll($data, array('validate' => 'first'))) {
				$this->Session->setFlash(sprintf(__('Raffles updated', true)));
			} else {
				if (Configure::read()) {
					$this->Session->setFlash(implode($this->Raffle->validationErrors, '<br />'));
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
			$term = trim($this->data['Raffle']['query']);
			$url = array(urlencode($term));
			if ($this->data['Raffle']['extended']) {
				$url['extended'] = true;
			}
			$this->redirect($url);
		}
		$request = $_SERVER['REQUEST_URI'];
		$term = trim(str_replace(Router::url(array()), '', $request), '/');
		if (!$term) {
			$this->redirect(array('action' => 'index'));
		}
		$conditions = $this->Raffle->searchConditions($term, isset($this->passedArgs['extended']));
		$this->Session->setFlash(sprintf(__('All raffles matching the term "%1$s"', true), htmlspecialchars($term)));
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
		$this->data = $this->Raffle->read(null, $id);
		if(!$this->data) {
			$this->Session->setFlash(__('Invalid raffle', true));
			return $this->_back();
		}
	}
	function home() {
	}

/**
 * index method
 *
 * @return void
 * @access public
 */
	function index() {
		$this->set('data', $this->paginate());
	}

/**
 * view method
 *
 * @param $id
 * @return void
 * @access public
 */
	function view($id) {
		$result = $this->Raffle->find(array('Raffle.id' => $id ));
		$this->set('availableTickets', $result["Raffle"]["available_tickets"]);
		$this->set('soldTickets', $result["Raffle"]["sold_tickets"]);
		$this->set('remainingTickets', $result["Raffle"]["available_tickets"] - $result["Raffle"]["sold_tickets"]);

		if(!empty($result["Raffle"]["winner_id"])){
			$user = $this->Raffle->Ticket->User->find(array("User.id" => $result["Raffle"]["winner_id"]));
			$this->set('winner_id', $result["Raffle"]["winner_id"]);
			$this->set('winner_user', $user["User"]["login"]);
			$this->set('winner_code', $result["Raffle"]["winner_code"]);
		}

		$result = $this->Raffle->Product->find(array('Product.id' => $result["Raffle"]["product_id"] ));
		$this->set('productDescription', $result["Product"]["description"]);
		$this->set('productShortDescription', $result["Product"]["short_description"]);
		$this->set('price', $result["Product"]["price"]);
	}

/**
 * winner method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
	function winner($id) {
		$winner = $this->Raffle->winner($id, true); // TODO temp. that's performing the winner selection if there's no existing winner
		if (!$winner) {
			$this->Session->setFlash(__('Sorry, that raffle doesn\'t exist', true));
			$this->_back();
		}
		$this->set('winner', $winner);
		if (!empty($winner['existing'])) {
			$this->Session->setFlash(__('And the winner was... %s', true), $winner['winner_code']);
			$this->Session->setFlash('And the winner was... ' . $winner['winner_code']);
			return;
		}
		$this->Session->setFlash(__('And the winner is... %s', true), $winner['winner_code']);
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
		$sets['products'] = $this->Raffle->Product->find('list', array('conditions' => array(
			'is_on_raffle' => 0
		)));
		$this->set($sets);
	}
}