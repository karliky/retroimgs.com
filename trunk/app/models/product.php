<?php

/**
 * Short description for product.php
 *
 * Long description for product.php
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
 * Product class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Product extends AppModel {
		var $displayField = 'name';

	/**
	 * belongsTo property
	 *
	 * @var array
	 * @access public
	 */
	var $belongsTo = array (
		'Category',
		'Provider',

	);

	var $hasOne = array(
		'Raffle',
	);

	var $validate = array (
		'commission' => array (
			'rule' => 'numeric',
			'message' => 'La comisión debe ser un número'
		),
		'name' => array (
			'rule' => 'notEmpty',
			'message' => 'El nombre debe tener más de 3 caracteres'
		),
		'short_description' => array (
			'rule' => 'notEmpty',
			'message' => 'Falta la descripción corta'
		),
		'description' => array (
			'rule' => 'notEmpty',

			'message' => 'Falta la descripción '
		),
		'price' => array (
			'rule' => 'numeric',
			'message' => 'El precio debe ser un número'
		),
		'video_url' => array (
			'allowEmpty'=>true,
			'rule' => 'url',
			'message' => 'La url de video no está bien '
		)


	);

}