<?php
/**
 * Short description for subscriber.php
 *
 * Long description for subscriber.php
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
 * @subpackage    rifalia.models
 * @since         v 1.0 (07-Jun-2009)
 * @license       tbd
 */

/**
 * Subscriber class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Subscriber extends AppModel {

/**
 * name property
 *
 * @var string 'Subscriber'
 * @access public
 */
	var $name = 'Subscriber';

/**
 * validate property
 *
 * @var array
 * @access public
 */
	var $validate = array(
		'name' => array(
			'rule' => 'notEmpty'
		),
		'mail' => 'email'
	);
}
?>