<?php
/**
 * Short description for rifalia.php
 *
 * Long description for rifalia.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2009, Rifaila.com
 *
 * Licensed under tbd
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2009, Rifalia.es
 * @link          www.rifalia.es
 * @package       rifalia
 * @subpackage    rifalia.views.helpers
 * @since         v 1.0 (22-Jun-2009)
 * @license       tbd
 */

/**
 * RifaliaHelper class
 *
 * @uses          AppHelper
 * @package       rifalia
 * @subpackage    rifalia.views.helpers
 */
class RifaliaHelper extends AppHelper {

/**
 * helpers property
 *
 * @var array
 * @access public
 */
	var $helpers = array(
		'Html',
		'Number',
		'Time'
	);

/**
 * settings property
 *
 * @var array
 * @access public
 */
	var $settings = array(
		'currency' => 'EUR',
		'show0' => false,
		'format' => true,
		'Number' => array(
			'EUR' => array(
				'before'=> '', 'after' => '&nbsp;€', 'zero' => 0, 'places' => 2, 'thousands' => '.',
				'decimals' => ',', 'negative' => '()', 'escape' => false
			)
		)
	);
	function picture($productId, $size = 'medium', $params = array()) {
		$data = MiCache::data('MediaLink', 'find', array('first', array(
			'recursive' => 0,
			'conditions' => array(
				'MediaLink.model' => 'Product',
				'MediaLink.foreign_key' => $productId,
				'main' => true
			)
		)));
		if ($data['Media']) {
			unset ($params['default']);
			return $this->Html->image($data['Media'], $size, $params);
		}
		if (!empty($params['default'])) {
			if ($params['default'] === true) {
				$params['default'] = $size . '.png';
			}
			return $this->Html->image($params['default']);
		}
		return null;
	}

/**
 * price method
 *
 * @param int $number 0
 * @param array $options array()
 * @return void
 * @access public
 */
	function price($number = 0, $options = array()) {
		extract(am($this->settings, $options));
		if (!$number && !$show0) {
			return;
		}
		$number = str_replace('.', ',', $this->Number->precision($number, 2));
		if ($format) {
			return '<strong>' . $number . ' €</strong>';
		}
		return $number;
	}

/**
 * timeRemaining method
 *
 * @param mixed $time null
 * @return void
 * @access public
 */
	function timeRemaining($time = null) {
		return $this->Time->timeAgoInWords($time);
	}
}