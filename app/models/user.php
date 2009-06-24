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
 * @var string 'username'
 * @access public
 */
	var $displayField = 'username';

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
		'Ticket',
		'Membership'
	);

/**
 * validate variable
 *
 * @var array
 * @access public
 */
	var $validate = array(
		'username' => array(
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
 * addBalance method
 *
 * @param mixed $amount
 * @return void
 * @access public
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
 * displayName method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	function displayName($id = null, $default = 'unknown') {
		if (!$id) {
			return $default;
		}
		if (is_scalar($id)) {
			$Inst =& ClassRegistry::init('User');
			if ($id === $Inst->id && !empty($Inst->data['User']['username'])) {
				$data = $this->data['User'];
			} else {
				$data = $Inst->find('first', array(
					'fields' => array('username'),
					'conditions' => array('User.id' => $id)
				));
				$data = $data['User'];
			}
		} else {
			$data = $id;
			if (isset($data['User'])) {
				$data = $data['User'];
			}
			if (empty($data['username'])) {
				if (empty($data['id'])) {
					return $default;
				}
				$Inst =& ClassRegistry::init('User');
				if ($id === $Inst->id && !empty($Inst->data[$Inst->alias]['username'])) {
					$data = $data['User'];
				} else {
					$data = $Inst->find('first', array(
						'fields' => array('username'),
						'conditions' => array('User.id' => $id)
					));
					$data = $data['User'];
				}
			}
		}
		return $data['username'];
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