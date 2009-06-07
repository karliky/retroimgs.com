<?php 
/* SVN FILE: $Id$ */
/* Rifalia schema generated on: 2009-06-07 12:06:07 : 1244372287*/
class RifaliaSchema extends CakeSchema {
	var $name = 'Rifalia';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
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
	var $media = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'filename' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'ext' => array('type' => 'string', 'null' => false, 'default' => 'gif', 'length' => 6),
		'dir' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'mimetype' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30),
		'filesize' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'height' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'width' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'checksum' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 32),
		'thumb' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $orders = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'amount' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'ticket_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_orders_user_id' => array('column' => 'user_id', 'unique' => 0), 'idx_orders_ticket_id' => array('column' => 'ticket_id', 'unique' => 0))
	);
	var $payment_gateways = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $products = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'provider_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'commission' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'raffle_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'short_description' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'price' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'video_url' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'is_on_raffle' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'is_approved' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_products_provider_id' => array('column' => 'provider_id', 'unique' => 0), 'idx_products_category_id' => array('column' => 'category_id', 'unique' => 0), 'idx_products_raffle_id' => array('column' => 'raffle_id', 'unique' => 0), 'idx_products_is_on_raffle' => array('column' => 'is_on_raffle', 'unique' => 0), 'idx_products_is_approved' => array('column' => 'is_approved', 'unique' => 0))
	);
	var $providers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'contact_person' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'phone' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'balance' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'default_commission' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $raffles = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'available_tickets' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'ticket_price' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'sold_tickets' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'closes' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'is_published' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'published' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'is_assigned' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'assigned' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'winner_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'winner_code' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'is_cancelled' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'cancelled' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_raffles_parent_id' => array('column' => 'parent_id', 'unique' => 0), 'idx_raffles_is_published' => array('column' => 'is_published', 'unique' => 0), 'idx_raffles_is_assigned' => array('column' => 'is_assigned', 'unique' => 0), 'idx_raffles_winner_id' => array('column' => 'winner_id', 'unique' => 0), 'idx_raffles_is_cancelled' => array('column' => 'is_cancelled', 'unique' => 0))
	);
	var $settings = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'value' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'type' => array('type' => 'string', 'null' => false, 'default' => 'string', 'length' => 30),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $tickets = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'raffle_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'transaction_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_tickets_raffle_id' => array('column' => 'raffle_id', 'unique' => 0), 'idx_tickets_transaction_id' => array('column' => 'transaction_id', 'unique' => 0))
	);
	var $transactions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'payment_gateway_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'transaction_type' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'amount' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'connection_details' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'authorisation_code' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'payment_requested' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'payment_response' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_transactions_payment_gateway_id' => array('column' => 'payment_gateway_id', 'unique' => 0), 'idx_transactions_user_id' => array('column' => 'user_id', 'unique' => 0))
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'login' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'key' => 'index'),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'key' => 'index'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'address' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'phone' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'balance' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'is_admin' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'is_enabled' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'is_email_verified' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'idx_users_login' => array('column' => 'login', 'unique' => 0), 'idx_users_email' => array('column' => 'email', 'unique' => 0))
	);
}
?>