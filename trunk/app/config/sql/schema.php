<?php 
/* SVN FILE: $Id$ */
/* Rifalia schema generated on: 2009-06-06 16:06:07 : 1244298907*/
class RifaliaSchema extends CakeSchema {
	var $name = 'Rifalia';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'descriptiion' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $products = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'tittle' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'short_description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'long_description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'lat' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'long' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'zoom' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'price' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'video' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'video_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'image' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'acept' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'acepted_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'categories_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'raffles_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_products_categories' => array('column' => 'categories_id', 'unique' => 0), 'fk_products_raffles' => array('column' => 'raffles_id', 'unique' => 0))
	);
	var $products_users = array(
		'users_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'products_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => array('users_id', 'products_id'), 'unique' => 1), 'fk_products_users_users' => array('column' => 'users_id', 'unique' => 0), 'fk_products_users_products' => array('column' => 'products_id', 'unique' => 0))
	);
	var $raffles = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'expirated_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'tickets_count' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'tickets_price' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'tickets_bought' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'last_ticket_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'status' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $tickets = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'number' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'reserved' => array('type' => 'boolean', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'raffles_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_tickets_raffles' => array('column' => 'raffles_id', 'unique' => 0))
	);
	var $tickets_users = array(
		'users_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'tickets_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => array('users_id', 'tickets_id'), 'unique' => 1), 'fk_tickets_users_users' => array('column' => 'users_id', 'unique' => 0), 'fk_tickets_users_tickets' => array('column' => 'tickets_id', 'unique' => 0))
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'mail' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'password' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $users_description = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'users_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'address' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'telephone' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'cash' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_users_description_users' => array('column' => 'users_id', 'unique' => 0))
	);
}
?>