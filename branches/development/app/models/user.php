<?php
/* SVN FILE: $Id$ */

/**
 * Short description for user.php
 *
 * Long description for user.php
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
 * @subpackage    base.models
 * @since         v 0.1
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * User class
 *
 * @uses          AppModel
 * @package       base
 * @subpackage    base.models
 */
class User extends AppModel {

/**
 * displayField property
 *
 * @var string 'login'
 * @access public
 */
	var $displayField = 'login';

/**
 * name property
 *
 * @var string 'User'
 * @access public
 */
	var $name = 'User';

/**
 * actsAs property
 *
 * @var array
 * @access public
 */
	var $actsAs = array(
		'UserAccount' => array('passwordPolicy' => 'weak', 'token' => array('length' => 10)),
	);

/**
 * hasMany property
 *
 * @var array
 * @access public
 */
	var $hasMany = array(
		'Order',
		'Ticket'
	);

/**
 * validate variable
 *
 * @var array
 * @access public
 */
	var $validate = array(
		'login' => array(
			'missing' => array('rule' => 'notEmpty', 'last' => true),
			'alphaNumeric' => array('rule' => 'alphaNumeric', 'last' => true),
			'tooShort' => array('rule' => array('minLength', 3), 'last' => true),
			'isUnique'
		),
		'email' => array(
			'missing' => array('rule' => 'notEmpty', 'last' => true),
			'email' => array('rule' => 'email', 'last' => true),
			'isUnique'
		),
	);

/**
 * Charge money method. t
 *
 * If  there are 2 possible causes
 * 	1) The user haven't
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
 * @TODO which method is this docblock documenting
 * @param mixed $reason
 * @return void
 * @access protected
 */
	function addBalance($amount) {
		if (!$this->id) {
			return false;
		}
		return $this->updateAll(
			array('balance' => 'balance + ' . $amount),
			array('id' => $this->id)
		);
	}

/**
 * haveMoney method
 *
 * @param mixed $id null
 * @param mixed $price
 * @return void
 * @access public
 */
    function haveMoney($id = null, $price){
           if ($id) {
                $this->id = $id;
           }
           if ($this->id) {
                if ($this->field('balance') > $price){
                    return true;
                }
           }
           return false;
    }

/**
 * chargeMoney method
 *
 * @param mixed $id null
 * @param mixed $price
 * @return void
 * @access public
 */
    function chargeMoney($id = null, $price){
           if ($id) {
                $this->id = $id;
           }
           if ($this->id) {
               $this->updateAll(array('balance' => 'balance - ' . $price), array('id' => $this->id));
          }
    }
}
?>