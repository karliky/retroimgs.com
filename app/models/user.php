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
}
?>