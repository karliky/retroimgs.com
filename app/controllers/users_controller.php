<?php
/* SVN FILE: $Id$ */

/**
 * Short description for users_controller.php
 *
 * Long description for users_controller.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2008, Andy Dawson
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2008, Andy Dawson
 * @link          www.ad7six.com
 * @package       base
 * @subpackage    base.controllers
 * @since         v 1.0
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * UsersController class
 *
 * @uses          AppController
 * @package       base
 * @subpackage    base.controllers
 */
class UsersController extends AppController {

/**
 * name property
 *
 * @var string 'Users'
 * @access public
 */
	var $name = 'Users';

/**
 * components property
 *
 * @var array
 * @access public
 */
	var $components = array('Auth', 'RequestHandler');

/**
 * beforeFilter method
 *
 * Allow access to the recovery methods if debug is enabled
 * Set the black hole to prevent white-screen-of-death symptoms for invalid form submissions.
 *
 * @access public
 * @return void
 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->fields = array(
			'username' => 'login',
			'password' => 'password'
		);
		$this->set('authFields', $this->Auth->fields);
		$this->Auth->allow('switch_language', 'register', 'forgotten_password', 'reset_password',
			'confirm_account', 'logout', 'back', 'register');
		$this->Auth->autoRedirect = false;
		if (isset($this->Security)) {
			$this->Security->blackHoleCallback = '_blackHole';
		}
	}

/**
 * beforeRender method
 *
 * @return void
 * @access public
 */
	function beforeRender() {
		unset($this->data['User'][$this->Auth->fields['password']]);
		unset($this->data['User']['confirm']);
		unset($this->data['User']['current_password']);
		return parent::beforeRender();
	}

/**
 * admin_index method
 *
 * @return void
 * @access public
 */
	function admin_index() {
		parent::admin_index();
		$ids = Set::extract($this->data, '/User/id');
		$displayNames = $this->User->find('list', array('conditions' => array('User.id' => $ids)));
		$this->set(compact('displayNames'));
	}

/**
 * back method
 *
 * the steps var is the number of steps to go back, incremented by 1 as the page displaying the back
 * link is the previous page, which would give the impression of going nowhere
 *
 * @param int $steps
 * @return void
 * @access public
 */
	function back($steps = 1) {
		$clear = isset($this->passedArgs['deleteHistoryEntry']);
		return $this->_back((int)$steps + 1, '/', true, $clear);
	}

/**
 * change_password method
 *
 * Used for changing the password of a logged in user
 *
 * @return void
 * @access public
 */
	function change_password() {
		if ($this->data) {
			list($return, $message) = $this->User->changePassword($this->data, $this->Auth->user());
			if ($message) {
				$this->Session->setFlash($message);
			}
			if ($return) {
				return $this->redirect('/');
			}
		}
		$strengths = array_keys($this->User->passwordPolicies());
		$this->set('strengths', array_combine($strengths, $strengths));
	}

/**
 * confirm method
 *
 * @param mixed $token
 * @return void
 * @access public
 */
	function confirm($token = null) {
		$this->set('token', $token);
		$fields = $this->User->accountFields();
		$this->set('fields', $fields);
		if (!$this->data) {
			return;
		}
		list($return, $message) = $this->User->confirmAccount($this->data);
		if ($message) {
			$this->Session->setFlash($message);
		}
		if ($return) {
			$this->Session->write('Auth.redirect', '/'); // Prevent auth from sending you back here
			return $this->redirect('/');
		}
	}

/**
 * edit method
 *
 * @return void
 * @access public
 */
	function edit() {
		if ($this->data) {
			//$this->data['User']['id'] = $this->Auth->user('id');
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('profile updated', true));
				return $this->_back();
			} else {
				$this->Session->setFlash(__('errors in form', true));
			}
		} else {
			$this->data = $this->User->read(null, $this->Auth->user('id'));
		}
		$this->_setSelects();
	}

/**
 * forgotten_password method
 *
 * Send the user an email with a confirmation link/token in it. Use the $email (which could be an email or a username)
 * to find the users id. Don't send another email if there is one that is pending
 *
 * @access public
 * @return void
 */
	function forgotten_password() {
		if ($this->data) {
			$email = $this->data['User']['email'];
			if (!$email) {
				$this->Session->setFlash(__('email missing', true));
				return;
			}
			list($return, $message) = $this->User->forgottenPassword($this->data['User']['email']);
			if ($message) {
				$this->Session->setFlash($message);
			}
			if ($return) {
				$this->redirect(array('action' => 'reset_password'));
			}
		}
	}

/**
 * login method
 *
 * Only run if there is no user
 *
 * @access public
 * @return void
 */
	function login() {
		if ($this->data) {
			if ($this->Auth->user('id')) {
				$this->User->id = $this->Auth->user('id');
				if (!empty($this->data['User']['remember_me'])) {
					$token = $this->User->token(null, array('length' => 100, 'fields' => array(
						$this->Auth->fields['username'], $this->Auth->fields['password']
					)));
					if(isset($this->SwissArmy)) {
						$this->SwissArmy->addComponent('Cookie');
						$this->Cookie->write('User.id', $this->User->id, true, '+2 weeks');
						$this->Cookie->write('User.token', $token, true, '+2 weeks');
					}
				}
				$display = $this->User->display();
				$this->Session->setFlash(sprintf(__('Welcome back %1$s.', true), $display));
				if ($this->RequestHandler->isAjax() && !empty($this->params['refresh'])) {
					return $this->redirect($this->Auth->redirect(), null, true, true);
				}
				return $this->redirect($this->Auth->redirect());
			}
		} elseif ($this->Auth->user('id')) {
			$this->Session->setFlash(__('You\'re already logged in!', true));
			return $this->_back(null, true);
		}
		if (Configure::read()) {
			$this->Session->setFlash('Debug only message: Save some tedium - check remember me.');
		}
	}

/**
 * logout method
 *
 * Delete the users cookie (if any), log them out, and send them a parting flash meassage. If no user is logged in just
 * send them back to where they came from (no reference to the session refer).
 *
 * @access public
 * @return void
 */
	function logout() {
		if ($this->Auth->user()) {
			if (isset($this->SwissArmy)) {
				$this->SwissArmy->addComponent('Cookie');
				$this->Cookie->del('User');
			}
			$this->Session->destroy();
			$this->Session->setFlash(__('now logged out', true));
		}
		$this->redirect($this->Auth->logout());
	}

/**
 * profile method
 *
 * @param mixed $username
 * @access public
 * @return void
 */
	function profile($username = null) {
		if ($username && $username != $this->Auth->user($this->Auth->fields['username'])) {
			/* Temp */
			$this->Session->setFlash(__('Not implemented', true));
			return $this->_back();
			/* Temp End */
			$id = $this->User->field('id', array($this->Auth->fields['username'] => $username));
		} else {
			$id = $this->Auth->user('id');
		}
		if (!$id) {
			$this->Session->setFlash(__('User not found', true));
			return $this->_back();
		}
		$conditions['User.id'] = $id;
		$this->data = $this->User->find('first', compact('conditions', 'contain'));
		if (!$this->data) {
			$this->Session->setFlash(__('User not found', true));
			return $this->_back();
		}
	}

/**
 * register method
 *
 * @access public
 * @return void
 */
	function register() {
		if (Configure::read()) {
			if ($this->User->find('count')) {
				$message = __('Registrations are disabled, change the Users.allowRegistrations setting to enable, or login as admin to create users.', true);
				$this->Session->setFlash($message, 'error');
				$this->redirect('/');
			}
			$message = __('Create a site admin user.', true);
			$this->Session->setFlash($message);
		} else {
			$message = __('Registrations are disabled.', true);
			$this->Session->setFlash($message, 'info');
			$this->redirect('/');
		}
		if ($this->data) {
			if (Configure::read() && !$this->User->find('count')) {
				if (isset($this->User->Group)) {
					$this->data['User']['group_id'] = $this->User->Group->field('id',
						array('name' => 'Admin'));
				} else {
					$this->data['User']['group'] = 'admin';
				}
			}
			list($return, $message) = $this->User->register($this->data);
			if ($message) {
				$this->Session->setFlash($message);
			}
			if ($return) {
				$this->Auth->login($this->User->id);
				return $this->redirect('/');
			}
		}
		$this->set('passwordPolicy', $this->User->passwordPolicy());
	}

/**
 * reset_password method
 *
 * Used to set a new password after requesting a reset via the forgotten password method
 *
 * @param string $token
 * @access public
 * @return void
 */
	function reset_password($token = null) {
		$this->set('token', $token);
		$loggedInUser = $this->User->id = $this->Auth->user('id');
		if ($loggedInUser) {
			$this->redirect(array('action' => 'change_password'));
		}
		$this->set('fields', $this->User->Behaviors->UserAccount->settings['User']['fields']);
		if (!$this->data) {
			return $this->render('confirm');
		}
		list($return, $message) = $this->User->resetPassword($this->data);
		if ($message) {
			$this->Session->setFlash($message);
		}
		if ($return) {
			$this->Session->write('Auth.redirect', '/'); // Prevent auth from sending you back here
			return $this->redirect(array('action' => 'login'));
		}
		$view = 'confirm';
		if ($this->data) {
			if (empty($this->User->validationErrors[$this->Auth->fields['username']]) &&
				empty($this->User->validationErrors['token'])) {
				$view = 'reset_password';
			}
		}
		$strengths = array_keys($this->User->passwordPolicies());
		$this->set('strengths', array_combine($strengths, $strengths));
		$this->render($view);
	}

/**
 * switch_language method
 *
 * @param string $language
 * @access public
 * @return void
 */
	function switch_language($language = 'eng') {
		if(isset($this->SwissArmy)) {
			$this->SwissArmy->addComponent('Cookie');
			$this->Cookie->write('User.id', $this->User->id, true, '+2 weeks');
			$this->Cookie->write('User.token', $token, true, '+2 weeks');
			$this->Cookie->write('lang', $language, null, '+350 day');
		}
		$this->Session->write('Config.language', $language);
		$this->_back();
	}

/**
 * blackHole method. Handles form submissions deemed invalid by the security component
 *
 * If a login is blackholed, there are 2 possible causes
 * 	1) The user went to /users/login but the form was tampered or the security token out of date
 * 	2) They used the sidebar login form, and the <not-users> controller doesn't use the security component
 *
 * In the first case, there is nothing to do but send the user back to the login form. In the second case, check if
 * their form submission contains a valid (session) user login token, and if so allow them to login; Otheriwse send to
 * the login form. This logic allows the users controller to use the security component, without forcing the rest of the
 * application to do so.
 *
 * If a user is already logged in, and the current action is not a login, then the user submitted a stale form -
 * call the parent blackHole handling method.
 *
 * @param mixed $reason
 * @return void
 * @access protected
 */
	function _blackHole($reason = null) {
		if ($reason == 'auth' && $this->action == 'login') {
			$formToken = isset($this->data['User']['login_token'])?$this->data['User']['login_token']:false;
			$sessionToken = $this->Session->read('User.login_token');
			if (!isset($this->data['_Token']) && $formToken && $sessionToken && $formToken === $sessionToken) {
				return true;
			}
			$token = Security::hash(String::uuid(), null, true);
			$this->Session->write('User.login_token', $token);
			$this->Session->setFlash(__('Invalid login submission', true));
			$this->redirect($this->Auth->loginAction);
		}
		return parent::_blackHole($reason);
	}
}
?>