<?php
/**
 * Short description for app_controller.php
 *
 * Long description for app_controller.php
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
 * @subpackage    base.controllers.abstract
 * @since         v 1.0
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * AppController class
 *
 * @uses          Controller
 * @package       base
 * @subpackage    base.controllers.abstract
 */
class AppController extends Controller {

/**
 * components property
 *
 * @var array
 * @access public
 */
	var $components = array(
		'SwissArmy' => array(
			'cookieAuth' => array(
				'username' => 'login',
				'password' => 'password',
				'+2 weeks'
			)
		),
		'MiSession',
		'Auth', 'RequestHandler'
	);

/**
 * helpers property
 *
 * @var array
 * @access public
 */
	var $helpers = array(
		'MiHtml', 'MiJavascript', 'MiForm',
		'Menu' => array('genericElement' => false),
		'Form', 'Html'
	);

/**
 * namedParams property
 *
 * @var bool true
 * @access public
 */
	var $namedParams = true;

/**
 * postActions property
 *
 * @var array
 * @access public
 */
	var $postActions = array('admin_delete');

/**
 * view property
 *
 * Use the MiView class
 *
 * @var string 'Mi'
 * @access public
 */
	var $view = 'Mi';

/**
 * construct method
 *
 * Prevent missing component error if the DebugKit toolbar isn't loaded, To run irrespective
 * of the debug setting - move outside the if (setting forceEnable to true you can use the
 * toolbar even with debug set to 0).
 * Puts the toolbar first so that initialization of other components is included in the 'Component
 * Initialization' timer
 *
 * @return void
 * @access private
 */
	function __construct() {
		if (Configure::read() && App::import('Component', 'DebugKit.Toolbar')) {
			$this->components = am(array('DebugKit.Toolbar' => array('forceEnable' => true)), $this->components);
		}
		return parent::__construct();
	}

/**
 * log method
 *
 * Always log the ip
 *
 * @param mixed $message
 * @param mixed $type
 * @return void
 * @access public
 */
	function log($message, $type = null) {
		if (!class_exists('RequestHandlerComponent')) {
			App::import('Component', 'RequestHandler');
		}
		if (!is_string($message)) {
			$message = print_r($message, true);
		}
		$message = RequestHandlerComponent::getClientIP() . "\t" . $message;
		parent::log($message, $type);
	}

/**
 * beforeFilter method
 *
 * Set a default page title from the po file
 * Set to ajax layout if it's a popup request
 * Also set the requirePost property of the security component to the controller's postActions property
 *
 * @return void
 * @access public
 */
	function beforeFilter() {
		Configure::read('Session.start', true);
		$this->Session->activate('/');
		$this->Auth->fields = array(
			'username' => 'login',
			'password' => 'password'
		);
		if (isset($this->SwissArmy)) {
			$this->SwissArmy->setDefaultPageTitle();
			$this->SwissArmy->handlePostActions();
		}
		$this->Auth->authorize = 'controller';
		$this->Auth->allow('index', 'view');
		$this->Auth->loginAction = '/users/login';
		$this->Auth->logoutRedirect = '/';
	}

/**
 * beforeRender method
 *
 * @return void
 * @access public
 */
	function beforeRender() {
		if (!isset ($this->viewVars['data'])) {
			$this->set('data', $this->data);
		}
		if (!isset ($this->viewVars['modelClass'])) {
			$this->set('modelClass', $this->modelClass);
		}
		if (!empty($this->postActions)) {
			$this->set('postActions', array(Inflector::underscore($this->name) => $this->postActions));
		}
		if (!empty($this->params['admin']) && empty($this->params['isAjax'])) {
			$this->layout = 'admin_default';
		}
	}

/**
 * redirect method
 *
 * If it's an ajax request, and the $force parameter is true - render a js redirect
 *
 * @param mixed $url
 * @param mixed $code null
 * @param bool $exit true
 * @param bool $force false
 * @return void
 * @access public
 */
	function redirect($url, $code = null, $exit = true, $force = false) {
		if (isset($this->SwissArmy)) {
			if ($this->SwissArmy->redirect($url, $code, $exit, $force) && $exit) {
				$this->_stop();
			}
		}
		return parent::redirect($url, $code, $exit);
	}

/**
 * admin_add method
 *
 * @return void
 * @access public
 */
	function admin_add() {
		if ($this->data) {
			if ($this->{$this->modelClass}->saveAll($this->data)) {
				$display = $this->{$this->modelClass}->display();
				$this->Session->setFlash(sprintf(__('%1$s "%2$s" added', true), $this->modelClass, $display));
				return $this->_back();
			} else {
				$this->data = $this->{$this->modelClass}->data;
				$this->Session->setFlash(__('errors in form', true));
			}
		}
		$this->_setSelects();
		$this->render('admin_edit');
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
			if ($this->{$this->modelClass}->saveAll($data, array('validate' => 'first', 'atomic' => false))) {
				$this->Session->setFlash(sprintf(__('%1$s added', true), $this->name));
				$this->_back();
			} else {
				$this->Session->setFlash(__('Some or all additions did not succeed', true));
			}
		} else {
			$this->data = array(array($this->modelClass => $this->{$this->modelClass}->create()));
			$this->data[0][$this->modelClass][$this->{$this->modelClass}->primaryKey] = null;
		}
		$this->_setSelects();
		$this->render('admin_multi_edit');
	}

/**
 * admin_multi_edit method
 *
 * Allow admins to edit multiple rows at once
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
			if ($this->{$this->modelClass}->saveAll($data, array('validate' => 'first'))) {
				$this->Session->setFlash(sprintf(__('%1$s updated', true), $this->name));
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
 * admin_delete method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
	function admin_delete($id) {
		$this->{$this->modelClass}->id = $id;
		if ($this->{$this->modelClass}->exists()) {
			$display = $this->{$this->modelClass}->display($id);
			if ($this->{$this->modelClass}->del($id)) {
				$this->Session->setFlash(sprintf(__('%1$s %2$s "%3$s" deleted', true), $this->modelClass, $id, $display));
			} else {
				$this->Session->setFlash(sprintf(__('Problem deleting %1$s %2$s "%3$s"', true), $this->modelClass, $id, $display));
			}
		} else {
			$this->Session->setFlash(sprintf(__('%1$s with id %2$s doesn\'t exist', true), $this->modelClass, $id));
		}
		return $this->_back();
	}

/**
 * admin_edit method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
	function admin_edit($id) {
		if ($this->data) {
			if ($this->{$this->modelClass}->saveAll($this->data)) {
				$display = $this->{$this->modelClass}->display();
				$this->Session->setFlash(sprintf(__('%1$s "%2$s" updated', true), $this->modelClass, $display));
				return $this->_back();
			} else {
				$this->data = $this->{$this->modelClass}->data;
				$this->Session->setFlash(__('errors in form', true));
			}
		} else {
			$this->data = $this->{$this->modelClass}->read(null, $id);
		}
		$this->_setSelects();
	}

/**
 * admin_view method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
	function admin_view($id) {
		$this->data = $this->{$this->modelClass}->read(null, $id);
		if(!$this->data) {
			$this->Session->setFlash(sprintf(__('Invalid %1$s', true), $this->modelClass));
			return $this->_back();
		}
	}

/**
 * admin_index method
 *
 * Use the Filer component to check for POST/GET data to use for searching.
 * An example of how to load a component for one action only
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
			$this->set('filters', $this->{$this->modelClass}->searchFilterFields());
			$this->set('addFilter', true);
		}
		$this->{$this->modelClass}->recursive = 1;
		$this->data = $this->paginate($conditions);
		$this->_setSelects();
	}

/**
 * admin_search method
 *
 * @param mixed $term
 * @return void
 * @access public
 */
	function admin_search($term = null) {
		if ($this->data) {
			$term = trim($this->data[$this->modelClass]['query']);
			$url = array(urlencode($term));
			if ($this->data[$this->modelClass]['extended']) {
				$url['extended'] = true;
			}
			$this->redirect($url);
		}
		$request = $_SERVER['REQUEST_URI'];
		$term = trim(str_replace(Router::url(array()), '', $request), '/');
		if (!$term) {
			$this->redirect(array('action' => 'index'));
		}
		$conditions = $this->{$this->modelClass}->searchConditions($term, isset($this->passedArgs['extended']));
		$this->Session->setFlash(sprintf(__('All %1$s matching the term "%2$s"', true),
			Inflector::humanize(Inflector::underscore($this->name)), htmlspecialchars($term)));
		$this->data = $this->paginate($conditions);
		$this->_setSelects();
		$this->render('admin_index');
	}

/**
 * admin_advanced_search method
 *
 * @param mixed $arg
 * @return void
 * @access public
 */
	function admin_advanced_search($arg = null) {
		if (isset($this->SwissArmy)) {
			$conditions = $this->SwissArmy->parseSearchFilter();
		} else {
			$conditions = array();
		}
		if ($this->data) {
			$this->redirect(array('action' => 'index'));
		}
		$this->{$this->modelClass}->recursive = 1;
		$this->set('filters', $this->{$this->modelClass}->searchFilterFields());
		$this->_setSelects();
		$this->render('/elements/filter');
	}

/**
 * admin_lookup method
 *
 * @param string $input ''
 * @return void
 * @access public
 */
	function admin_lookup($input = '') {
		if (isset($this->SwissArmy)) {
			return $this->SwissArmy->lookup($input);
		}
		return false;
	}

/**
 * isAuthorized method
 *
 * Simple example, if it's an admin request and the user isn't in the admin group deny. Otherwise - allow
 *
 * @return void
 * @access public
 */
	function isAuthorized() {
		if (isset($this->params['admin']) && !$this->Auth->user('is_admin')) {
			return false;
		}
		return true;
	}

/**
 * back method
 *
 * (hopefully) Intelligent referer logic
 * Convenience method to call the back method in the Swiss army component. Can be overriden if the true
 * referer is not actually useful.
 *
 * @param int $steps
 * @return void
 * @access protected
 */
	function _back($steps = 1, $force = false) {
		if (isset($this->SwissArmy)) {
			if (($force || in_array($this->action, $this->postActions)) && $this->RequestHandler->isAjax()) {
				$url = $this->SwissArmy->back($steps, null, false);
				return $this->redirect($url, null, true, true);
			}
			return $this->SwissArmy->back($steps);
		}
		return $this->redirect($this->referer('/', true));
	}

/**
 * black hole method
 *
 * If a GET request is made for a method that must be run via POST/DELETE
 * present a confirmation screen which submits by POST/DELETE
 *
 * @param mixed $reason
 * @return void
 * @access protected
 */
	function _blackHole($reason = null) {
		if (isset($this->SwissArmy)) {
			return $this->SwissArmy->blackHole($reason);
		}
		return false;
	}

/**
 * setSelects method
 *
 * Populate variables used for selects
 *
 * @return void
 * @access protected
 */
	function _setSelects($params = array()) {
		if (isset($this->SwissArmy)) {
			$this->SwissArmy->setSelects($params);
			return true;
		}
		return false;
	}
}
?>