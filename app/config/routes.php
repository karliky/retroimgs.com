<?php
/* SVN FILE: $Id$ */

/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * the ajax 'extension' is used to ensure there's no cache-confusion between ajax requests, and fullpage requests
 */
Router::parseExtensions('ajax');

	Router::connect('/', array('controller' => 'raffles', 'action' => 'index'));
	Router::connect('/admin/', array('admin' => true, 'controller' => 'products', 'action' => 'index'));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * If the code reaches here, there  is no cached or vendor-served css/js/etc file.
 * Serve images and files that look like app-generated requests via the media controller
 */
Router::connect('/img/c/:id-:filename', array('controller' => 'media', 'action' => 'serve'),
	array('id' => '\d+', 'filename' => '.*\.(png|PNG|jpg|JPG|jpeg|JPEG|gif|GIF|bmp|BMP)'));
Router::connect('/files/c/:id-:filename', array('controller' => 'media', 'action' => 'serve'), array('id' => '\d+'));

/**
 * Forward css and js files to the dev controller
 */
Router::connect('/(css|js)/*', array('controller' => 'dev', 'action' => 'serve'));

/**
 * Capture missing images and files and prevent them swallowing flash messages and generally being a pain
 */
Router::connect('/(img|files)/*', array('controller' => 'dev', 'action' => 'null'));