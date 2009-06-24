<?php
/**
 * Short description for feed.php
 *
 * Long description for feed.php
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
 * @subpackage    rifalia.models
 * @since         v 1.0 (15-Jun-2009)
 * @license       tbd
 */

/**
 * Feed class
 *
 * @uses
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Feed {

/**
 * data property
 *
 * @var array
 * @access public
 */
	var $data = array();

/**
 * url property
 *
 * @var string ''
 * @access public
 */
	var $url = '';

/**
 * hasMany property
 *
 * @var array
 * @access public
 */
	var $hasMany = array('FeedItem');

/**
 * read method
 *
 * @param mixed $url
 * @return void
 * @access public
 */
	function read($url) {
		$this->url = $url;
		$this->data = implode ("", file($url));
		return $this->get_items();
	}

/**
 * get_items method
 *
 * @return void
 * @access public
 */
	function get_items() {
		if (!$this->data) {
			return false;
		}
		preg_match_all ("/<item .*>.*<\/item>/xsmUi", $this->data, $matches);
		$items = array ();
		foreach ($matches[0] as $match){
			$items[] = $this->FeedItem->parse($match);
		}
		return $items;
	}
}