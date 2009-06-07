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
 * @copyright     Copyright (c) 2009, Rifalia.com
 * @link          www.rifalia.com
 * @package       rifalia
 * @subpackage    rifalia.controllers
 * @since         v 1.0 (07-Jun-2009)
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
 * scaffold property
 *
 * @var array
 * @access public
 */
	var $scaffold = array('index', 'add', 'edit', 'delete');

/**
 * name property
 *
 * @var string 'Tickets'
 * @access public
 */
	var $name = 'Tickets';
}