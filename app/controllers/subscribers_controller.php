<?php
/**
 * Short description for subscribers_controller.php
 *
 * Long description for subscribers_controller.php
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
 * SubscribersController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class SubscribersController extends AppController {

/**
 * scaffold property
 *
 * @var array
 * @access public
 */
	var $scaffold = array('index', 'add', 'edit', 'delete', 'view');

/**
 * name property
 *
 * @var string 'Subscribers'
 * @access public
 */
	var $name = 'Subscribers';

	function index() {
		$this->Session->setFlash("Subscríbete por email para que te mantengamos informado:");
		$this->set('data', $this->paginate());
	}
	
	function add() {
		$this->Subscriber->set($this->data);
		if ($this->Subscriber->validates()) {
			$this->Session->setFlash('¡Gracias por registrar tu email!');
			$this->Subscriber->save($this->data);
		} else {
			//$this->Session->setFlash(__('errors in form', true));
			$this->Session->setFlash("Por favor, rellena tu nombre y una dirección de correo válida:");
			$this->redirect(array('action' => 'index'));
		}
	}
}
