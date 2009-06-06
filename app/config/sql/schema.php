<?php 
/* SVN FILE: $Id$ */
/* Rifalia schema generated on: 2009-06-06 19:06:47 : 1244308847*/
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
	var $emails = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'from_user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'to_user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'chain_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'ip' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'send_date' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'status' => array('type' => 'string', 'null' => false, 'default' => 'unsent', 'length' => 30),
		'type' => array('type' => 'string', 'null' => true, 'default' => 'normal', 'length' => 10),
		'from' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'to' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'reply_to' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'cc' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'bcc' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'send_as' => array('type' => 'string', 'null' => false, 'default' => 'both', 'length' => 4),
		'subject' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'template' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'layout' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'data' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $enums = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30),
		'order' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 2),
		'display' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'value' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'default' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
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
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'group' => array('type' => 'string', 'null' => true, 'default' => 'normal', 'length' => 15),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 41),
		'email_verified' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'last_name' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'pic' => array('type' => 'string', 'null' => true, 'default' => NULL),
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