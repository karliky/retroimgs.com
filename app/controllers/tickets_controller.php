<?php
/**
 * Short description for tickets_controller.php
 *
 * Long description for tickets_controller.php
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
 * @since         v 1.0 (22-Jun-2009)
 * @license       tbd
 */

/**
 * TicketsController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class TicketsController extends AppController {

/**
 * name property
 *
 * @var string 'Tickets'
 * @access public
 */
	var $name = 'Tickets';

/**
 * paginate property
 *
 * @var array
 * @access public
 */
	var $paginate = array(
		'Ticket' => array(
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
			if ($this->Ticket->saveAll($this->data)) {
				$display = $this->Ticket->display();
				$this->Session->setFlash(sprintf(__('Ticket "%1$s" added', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Ticket->data;
				if (Configure::read()) {
					foreach ($this->Ticket->validationErrors as $i => &$error) {
						if (is_array($error)) {
							$error = implode($error, '<br />');
						}
					}
					$this->Session->setFlash(implode($this->Ticket->validationErrors, '<br />'));
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
		$this->Ticket->id = $id;
		if ($id && $this->Ticket->exists()) {
			$display = $this->Ticket->display($id);
			if ($this->Ticket->del($id)) {
				$this->Session->setFlash(sprintf(__('Ticket %1$s "%2$s" deleted', true), $id, $display));
			} else {
				$this->Session->setFlash(sprintf(__('Problem deleting Ticket %1$s "%2$s"', true), $id, $display));
			}
		} else {
			$this->Session->setFlash(sprintf(__('Ticket with id %1$s doesn\'t exist', true), $id));
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
			if ($this->Ticket->saveAll($this->data)) {
				$display = $this->Ticket->display();
				$this->Session->setFlash(sprintf(__('Ticket "%1$s" updated', true), $display));
				return $this->_back();
			} else {
				$this->data = $this->Ticket->data;
				if (Configure::read()) {
					foreach ($this->Ticket->validationErrors as $i => &$error) {
						if (is_array($error)) {
							$error = implode($error, '<br />');
						}
					}
					$this->Session->setFlash(implode($this->Ticket->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('errors in form', true));
				}
			}
		} elseif ($id) {
			$this->data = $this->Ticket->read(null, $id);
			if (!$this->data) {
				$this->Session->setFlash(sprintf(__('Ticket with id %1$s doesn\'t exist', true), $id));
				$this->_back();
			}
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
			$this->set('filters', $this->Ticket->searchFilterFields());
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
		if (!$this->data = $this->Ticket->find('list', compact('conditions'))) {
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
			if ($this->Ticket->saveAll($data, array('validate' => 'first', 'atomic' => false))) {
				$this->Session->setFlash(sprintf(__('Tickets added', true)));
				$this->_back();
			} else {
				if (Configure::read()) {
					foreach ($this->Ticket->validationErrors as $i => &$error) {
						if (is_array($error)) {
							$error = implode($error, '<br />');
						}
					}
					$this->Session->setFlash(implode($this->Ticket->validationErrors, '<br />'));
				} else {
					$this->Session->setFlash(__('Some or all additions did not succeed', true));
				}
			}
		} else {
			$this->data = array('1' => array('Ticket' => $this->Ticket->create()));
			$this->data[1]['Ticket']['id'] = null;
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
			if ($this->Ticket->saveAll($data, array('validate' => 'first'))) {
				$this->Session->setFlash(sprintf(__('Tickets updated', true)));
			} else {
				if (Configure::read()) {
					foreach ($this->Ticket->validationErrors as $i => &$error) {
						if (is_array($error)) {
							$error = implode($error, '<br />');
						}
					}
					$this->Session->setFlash(implode($this->Ticket->validationErrors, '<br />'));
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
			$term = trim($this->data['Ticket']['query']);
			$url = array(urlencode($term));
			if ($this->data['Ticket']['extended']) {
				$url['extended'] = true;
			}
			$this->redirect($url);
		}
		$request = $_SERVER['REQUEST_URI'];
		$term = trim(str_replace(Router::url(array()), '', $request), '/');
		if (!$term) {
			$this->redirect(array('action' => 'index'));
		}
		$conditions = $this->Ticket->searchConditions($term, isset($this->passedArgs['extended']));
		$this->Session->setFlash(sprintf(__('All tickets matching the term "%1$s"', true), htmlspecialchars($term)));
		$this->data = $this->paginate($conditions);
		$this->_setSelects();
		$this->render('admin_index');
	}

/**
 * admin_view method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	function admin_view($id = null) {
		$this->data = $this->Ticket->read(null, $id);
		if(!$this->data) {
			$this->Session->setFlash(__('Invalid ticket', true));
			return $this->_back();
		}
	}
	function reserve($raffleId = null, $slug) {
		if ($this->data) {
			if ($this->Ticket->reserve($this->data['Ticket'])) {
				$this->Session->setFlash(sprintf(__('Tickets reserved', true)));
			} else {
				$this->Session->setFlash(__('Please check the form below', true));
			}
			$raffle = $this->Ticket->Raffle->read(null, $raffleId);
		} else {
			$raffle = $this->Ticket->Raffle->read(null, $raffleId);
			if (!$raffle) {
				$this->Session->setFlash(__('Invalid ticket', true));
				return $this->_back();
			}
			$this->data['Ticket']['raffle_id'] = $raffleId;
		}
		$this->set('raffle', $raffle);
	}

/**
 * reserved_ticket method
 *
 * @param mixed $count
 * @param mixed $numberTicket
 * @param mixed $idRaffle
 * @param mixed $userId
 * @return void
 * @access public
 */
    function reserved_ticket($count, $numberTicket, $idRaffle, $userId) {
         $raffleSearch = $this->Ticket->Raffle->find(array('Raffle.id' =>  $idRaffle)); // Accedo mediante  $numberMax['Raffle']['available_tickets']
         $price = $raffleSearch['Raffle']['ticket_price'];
         $total_cost = $price * $count;
         if (!empty($raffleSearch)) { // existe la rifa
                   if ($count != 1){
                        if ($this->Ticket->User->haveMoney($userId,$total_cost)){
                                for ($i=1; $i < $count+1;$i++){
                                         $id_result = $this->Ticket->find(array('raffle_id' => $idRaffle, "Ticket.user_id" => null), "code", array('rand()'));
                                         $order = $this->Ticket->Order->generateOrder($id_result['Ticket']['id'], $price, $userId);
                                         $this->Ticket->User->chargeMoney($userId, $price);
                                         $this->saveTicket($id_result['Ticket']['id'], $userId);
                                }
                                $this->Ticket->Raffle->ticketsBought($idRaffle, $count);
                                $this->Session->setFlash('Reserva realizada con exito ¡¡ Munchisima suerte campeón tu lo mereces !!.');
                        }else{
                             $this->Session->setFlash('No dispones de suficiente saldo.');
                        }
                   }else{
                        if (!empty($numberTicket)) { // ha introducido un numero
                            // Comprobar que existe idraffle
                            // Comprobar que el numero introducido está en el rango
                            // Todo Ok  Creo transsaccion
                            // Asigno al ticket el id transaccion
                            // Creo el order y le asigno el id transaccion.
                            // Relleno el campo amount que me vendrá dado por el ratio de precio de la rifa.
                            // Tablas a modificar: Raffles ( sold_ticket + 1), Tickets ( code, user_id, rafle_id, transaction_id ), Orders (user_id, amount,
                            // transaction_id, ¿description?)

                                $result = $this->Ticket->find(array('code' => $numberTicket, "Ticket.user_id" => null ));
                              if ($result['Ticket']['id']!= null) {// El numero está libre;
                                     if ($this->Ticket->User->haveMoney($userId, $price)){
                                            $order = $this->Ticket->Order->generateOrder($result['Ticket']['id'], $price, $userId);
                                            $this->Ticket->User->chargeMoney($userId, $price);
                                            $this->Ticket->Raffle->ticketsBought($idRaffle, 1);
                                            $this->saveTicket($result['Ticket']['id'], $userId);
                                            $this->Session->setFlash('Reserva realizada con exito del numero '.$numberTicket.' ¡¡ Munchisima suerte campeón tu lo mereces !!');
                                     }else{
                                       $this->Session->setFlash('No dispones de suficiente saldo racano pon pasta.');
                                     }
                                        //Genero ticket Generoticket($number)
                                        //Genero Order  GeneroOrder($ticket)
                                        //Modifico Rifa  Modificorifa(vendidos + 1)
                                 }else{
                                     $this->Session->setFlash('El numero no esta disponible prueba otro listillo');
                                 }

                         }else{
                             $this->Session->setFlash('No has introducido un numero te crees que me chupo el dedo');
                         }
                   }
         }else{
                  $this->Session->setFlash('La rifa no existe');
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
		$sets['orders'] = $this->Ticket->Order->find('list');
		$sets['raffles'] = $this->Ticket->Raffle->find('list');
		$sets['transactions'] = $this->Ticket->Transaction->find('list');
		$sets['users'] = $this->Ticket->User->find('list');
		$this->set($sets);
	}
}