<?php
/**
 * Short description for prize.php
 *
 * Long description for prize.php
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
 * Prize class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Prize extends AppModel {

/**
 * displayField property
 *
 * @var string 'name'
 * @access public
 */
	var $displayField = 'name';

/**
 * actsAs property
 *
 * @var array
 * @access public
 */
	var $actsAs = array(
		'Slugged',
		'Tracked'
	);

/**
 * belongsTo property
 *
 * @var array
 * @access public
 */
	var $belongsTo = array (
		'Category',
		'Provider' => array(
			'className' => 'Organization',
			'conditions' => array('Organization.type' => 'Provider')
		),
	);

/**
 * hasOne property
 *
 * @var array
 * @access public
 */
	var $hasOne = array(
		'Raffle',
		'MediaLink'  => array(
			'foreignKey' => 'foreign_key',
			'conditions' => array(
				'MediaLink.model' => 'Prize',
				'MediaLink.main' => 1,
			)
		),
		'Media'  => array(
			'foreignKey' => false,
			'conditions' => array(
				'MediaLink.media_id = Media.id'
			)
		)
	);

/**
 * validate property
 *
 * @var array
 * @access public
 */
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