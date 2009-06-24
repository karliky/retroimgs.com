<?php
/**
 * Short description for feed_item.php
 *
 * Long description for feed_item.php
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
 * FeedItem class
 *
 * @uses
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class FeedItem {
	var $title;
	var $url;

/**
 * Enter Description Here
 */
	var $description;

/**
 * parse method
 *
 * @param mixed $xml
 * @return void
 * @access public
 */
	function parse ($xml){
		preg_match ("/<title> (.*) <\/title>/xsmUi", $xml, $matches);
		$this->title = $matches[1];
		preg_match ("/<link> (.*) <\/link>/xsmUi", $xml, $matches);
		$this->url = $matches[1];
		return array('title' => $title, 'url' => $this->url);
	}

/**
 * get_title method
 *
 * @return void
 * @access public
 */
	function get_title (){
		return $this->title;
	}

/**
 * get_url method
 *
 * @return void
 * @access public
 */
	function get_url (){
		return $this->url;
	}

/**
 * get_description method
 *
 * @return void
 * @access public
 */
	function get_description (){
		return $this->description;
	}
}