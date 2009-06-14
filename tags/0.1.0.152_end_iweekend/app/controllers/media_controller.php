<?php
/**
 * Short description for media_controller.php
 *
 * Long description for media_controller.php
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
 * MediaController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class MediaController extends AppController {

/**
 * name property
 *
 * @var string 'Media'
 * @access public
 */
	var $name = 'Media';

/**
 * paginate property
 *
 * @var array
 * @access public
 */
	var $paginate = array('limit' => 10, 'order' => 'Media.id DESC');

/**
 * publicAccess property
 *
 * If set to true, you don't need to login to see uploaded, mediaView served, content.
 * Otherwise, you do.
 *
 * @var bool true
 * @access public
 */
	var $publicAccess = true;

/**
 * fallback property
 *
 * @var string 'thumb.gif'
 * @access private
 */
	var $__fallback = 'thumb.gif';

/**
 * Don't merge anything if it's a (the) public function
 *
 * @return void
 * @access protected
 */
	function __mergeVars() {
		if (strpos($this->here, 'admin') === 1) {
			return parent::__mergeVars();
		}
		$this->components = false;
		$this->helpers = false;
	}

/**
 * beforeFilter method
 *
 * @return void
 * @access public
 */
	function beforeFilter() {
		if (isset($this->params['admin'])) {
			$this->start = microtime(true);
			$this->helpers[] = 'Number';
			$this->Media->bindModel(array('belongsTo' => array('User')));
			parent::beforeFilter();
		} else {
			if (isset($this->SwissArmy)) {
				$this->SwissArmy->enabled = false;
			}
		}
	}

/**
 * admin_add method
 *
 * GET request for /admin/add/ModelName/ModelId will create a media for ModelName.ModelId
 *
 * @param string $model
 * @param mixed $foreignKey
 * @access public
 * @return void
 */
	function admin_add() {
		$this->Media->Behaviors->disable('Scoped');
		$this->paginate['limit'] = 20;
		$this->paginate['order'] = 'Media.created DESC';
		$this->paginate['recursive'] = 0;
		$this->paginate['conditions'] = array(
			'Media.mimetype LIKE' => 'image%',
			'Media.site_id' => $this->siteId
		);
		if ($this->data) {
			$this->Media->factoryMode();
			$this->data[$this->modelClass]['user_id'] = $this->Auth->user('id');
			$this->data[$this->modelClass]['site_id'] = $this->siteId;
			$this->Media->create($this->data);
			if ($this->Media->validates()) {
				$this->Media->begin();
				$this->Media->create();
				$this->Media->save();
				if ($data = $this->Media->save($this->data, true)) {
					$this->Media->commit();
					$mode = $this->Media->factoryMode();
					$this->Media->Behaviors->$mode->settings['Media']['versions'] = array();
					$this->Media->reprocess($this->Media->id);
					clearcache();
					if ($this->params['url']['ext'] === 'ajax') {
						$this->set('files', $this->paginate());
						return $this->render('admin_add', 'ajax');
					}
					$this->Session->setFlash(__('New Media uploaded', true));
					$this->_back();
				}
				$this->Media->rollback();
			}
		}
		$this->set('files', $this->paginate());
		$this->render('admin_add');
	}

/**
 * admin_clear_webroot method
 *
 * @param string $type
 * @access public
 * @return void
 */
	function admin_clear_webroot() {
		system('rm -rf ' . APP . 'webroot/img/c/*');
		system('rm -rf ' . APP . 'webroot/files/c/*');
		$folder = new Folder(APP . 'uploads');
		list($dirs) = $folder->ls();
		foreach ($dirs as $dir) {
			if ($dir[0] === '.' || $this->Media->find('count', array('conditions' => array('dir LIKE' => $dir . '%')))) {
				continue;
			}
			system('rm -rf ' . APP . 'uploads/' . $dir);
		}
		//$files = $folder->findRecursive();
		$this->_back();
	}

/**
 * admin_edit method
 *
 * Edit descriptions etc for an attacment. Not used to upload a new version of a file
 *
 * @param mixed $id
 * @access public
 * @return void
 */
	function admin_edit($id) {
		$this->Media->factoryMode();
		if (!empty($this->data)) {
			$this->data[$this->modelClass]['user_id'] = $this->Auth->user('id');
			if ($this->Media->save($this->data)) {
				$this->Session->setFlash(sprintf(__('%s with id %s updated', true), $this->modelClass, $id));
				return $this->_back();
			} else {
				$this->Session->setFlash(__('errors in form', true));
			}
		} else {
			$this->data = $this->Media->read(null, $id);
		}
		$this->_setSelects($this->data[$this->modelClass]['model']);
		$this->render('admin_edit');
	}

/**
 * admin_export method
 *
 * @return void
 * @access public
 */
	function admin_export() {
		$recursive = -1;
		$this->data = $this->Media->find('all', compact('recursive'));
		$filename = 'media_backup_' . date('Ymd-Hi') . '.xml';
		$this->RequestHandler->renderAs($this, 'xml');
		if (!isset($this->params['requested'])) {
			Configure::write('debug', 0);
			$this->RequestHandler->respondAs('xml', array('media' => $filename));
		}
		//$file = new File(TMP . $filename);
		//$file->write($out);
	}

/**
 * admin_images method
 *
 * @return void
 * @access public
 */
	function admin_images() {
		$this->Media->Behaviors->disable('Upload');
		$this->Media->Behaviors->attach('ImageUpload');
		$this->paginate['conditions'] = array('Media.mimetype LIKE' => 'image%');
		$this->paginate['limit'] = 20;
		$this->paginate['recursive'] = 0;
		$this->admin_index();
	}

/**
 * admin_import method
 *
 * @return void
 * @access public
 */
	function admin_import() {
		if ($this->data) {
			if ($this->data['Media']['take_backup']) {
				$this->requestAction('/admin/media/export', array('return'));
			}
			if (!$this->data['Media']['file']['error']) {
				$xml = file_get_contents($this->data['Media']['file']['tmp_name']);
				$file = new File(TMP . 'media_imported_' . date('Ymd-Hi') . '.xml');
				$file->write($xml);
			} elseif ($this->data['Media']['backup']) {
				$xml = file_get_contents(TMP . $this->data['Media']['backup']);
			} else {
				$this->Session->setFlash('No Xml file to import');
				$this->redirect(array());
			}
			$uploads = 0;
			uses('Xml');
			$xml = new Xml($xml);
			$xml = Set::reverse($xml);
			$meta = Set::extract($xml, '/Contents/Meta');
			$media = Set::extract($xml, '/Contents/Media');
			if ($media) {
				foreach ($media as $row) {
					extract ($row['Media']);
					$conditions = compact('model', 'foreign_key', 'filename', 'dir');
					$existing = $this->Media->field('id', $conditions);
					$file = new File(APP . 'uploads' . DS . $dir . DS . $filename, true);
					$file->write(base64_decode($source));
					$this->Media->create();
					unset ($row['Media']['id']);
					if ($existing) {
						$this->Media->id = $existing;
					}
					if (!isset($row['Media']['user_id']) || !$row['Media']['user_id']) {
						$row['Media']['user_id'] = $this->Auth->user('id');
					}
					if ($this->Media->save($row)) {
						$this->Media->reprocess();
						$uploads++;
					}
				}
			}
			$message = array();
			if ($uploads) {
				$message[] = $uploads . ' images imported';
			}
			if ($message) {
				$message = implode ($message, '. ') . '.';
			} else {
				$message = 'File imported but no changes detected';
			}
			$this->Session->setFlash($message);
			return $this->_back();
		}
		$tmp = new Folder(TMP);
		$backups = $tmp->find('media_.*\.xml');
		if ($backups) {
			$backups = array_combine($backups, $backups);
			$backups = array_reverse($backups);
		} else {
			$backups = array();
		}
		$this->set('backups', $backups);
	}

/**
 * admin_view method
 *
 * @param mixed $id
 * @param mixed $slug
 * @param string $size
 * @access public
 * @return void
 */
	function admin_view($id, $slug = null, $size = null) {
		$this->Media->factoryMode();
		$this->data = $this->Media->read();
	}

/**
 * admin_reprocess method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	function admin_reprocess($id = null) {
		set_time_limit(60);
		static $processed = array();
		if (!empty($this->params['named']['all'])) {
			$this->Media->order = 'Media.id ASC';
			if (!$id) {
				$id = $this->Media->field('id');
			}
		}
		$this->Media->read();
		$this->Media->clearWebroot($id);
		$behavior = $this->Media->factoryMode();
		$this->Media->Behaviors->$behavior->settings['Media']['versions'] = array();
		$this->Media->reprocess($id);
		if (!empty($this->params['named']['all'])) {
			$processed[] = $id;
			$next = $this->Media->field('id', array('Media.id >' => $id));
			if ($next) {
				if (round(getMicrotime() - $this->start, 4) < 20) {
					$this->admin_reprocess($next);
					$this->autoRender = false;
					return;
				}
				Configure::write('debug', 0);
				$count = $this->Media->find('count', array('conditions' => array('Media.id >' => $next)));
				return $this->flash(
					sprintf(__('Files %s reprocessed, redirecting to continue with file %s. %s remaining', true), implode($processed, ', '), $next, $count),
					array($next, 'all' => true)
				);
			}
		} else {
			$this->Session->setFlash(sprintf(__('File %s has been reprocessed', true), $this->Media->display()));
		}
		$this->_back();
	}

/**
 * serve method
 *
 * @return void
 * @access public
 */
	function serve() {
		$this->autoRender = false;
		if (empty($this->params['id'])) {
			header("HTTP/1.0 404 Not Found");
			$this->log('Not a valid request for ' . $this->params['url']['url'], 'MediaController');
			return;
		}
		$id = $this->params['id'];
		$name = $this->params['filename'];
		if (!is_numeric($id)) {
			header("HTTP/1.0 404 Not Found");
			$this->log('Invalid request for ' . $this->params['url']['url'], 'MediaController');
			return;
		}
		$row = $this->Media->read(null, $id);
		if (!$row) {
			header("HTTP/1.0 404 Not Found");
			$this->log('No file found for ' . $this->params['url']['url'], 'MediaController');
			return;
		}
		if (!empty($this->params['isAjax']) || strpos($this->params['url']['url'], '.ajax')) {
			$this->autoLayout = false;
			$this->set('data', $row['Media']);
			if (strpos(trim($this->params['url']['url'], '/'), 'img') === 0) {
				$this->set('type', 'image');
			} else {
				$this->set('type', 'other');
			}
			$this->render('popup');
			Configure::write('debug', 0);
			return;
		}
		$this->log('Processing ' . $this->params['url']['url'], 'MediaController');
		// Create a symlink to the default image to prevent successive requests
		// if processing this request fails
		preg_match('@_([^_]*)\.@', $name, $match);
		if ($match[1] && file_exists(IMAGES . $match[1] . '.gif')) {
			$this->__fallback = $match[1] . '.gif';
		}

		$mode = $this->Media->factoryMode();
		if (!$mode) {
			$this->Media->reprocess($id);
			$mode = $this->Media->factoryMode();
			if (!$mode) {
				header("HTTP/1.0 404 Not Found");
				$this->log('	Doesn\'t look like a valid file', 'MediaController');
				return $this->_serve($this->__fallback);
			}
		}
		if (strpos(trim($this->params['url']['url'], '/'), 'img') === 0) {
			return $this->_serve_image($id, $name, $row, $mode);
		} elseif (!Configure::read() && $name !== $row['Media']['filename']) {
			header("HTTP/1.0 404 Not Found");
			$this->log('	Invalid request', 'MediaController');
			return $this->_serve($this->__fallback);
		}
		$this->_serve_file($id, $row['Media']['filename'], $row);
	}

/**
 * serve_file method
 *
 * @param mixed $id
 * @param mixed $name null
 * @return void
 * @access public
 */
	function _serve_file($id, $name, $row) {
		$target = preg_replace('@[\\/]+@', '/', WWW_ROOT . $this->params['url']['url']);
		exec('ln -s ' . $this->Media->absolutePath() . ' ' . $target);
		return $this->_serve($target);
	}

/**
 * serve_image method
 *
 * @param mixed $id
 * @param mixed $name null
 * @return void
 * @access public
 */
	function _serve_image($id, $name, $row, $mode) {
		preg_match('@_([^_]*)\.@', $name, $match);
		if (!empty($match[1])) {
			$size = $match[1];
		} else {
			$size = 'default';
		}
		include(CONFIGS . 'media.php');
		$sizeMap = $config['Media'];
		extract ($row['Media']);
		if ($mode === 'ImageUpload') {
			$this->Media->recursive = -1;
			$path = false;
			if ($name === $filename) {
				$size = 'default';
			} else {
				if (!isset($sizeMap[$size])) {
					header("HTTP/1.0 404 Not Found");
					$this->log('	No file found', 'MediaController');
					return $this->_serve($this->__fallback);
				}
				$test = str_replace('.', '_' . $size . '.', $filename);
				if ($test !== $name) {
					$this->log('	bad request from ' . $this->referer());
					$this->log('	Request doesn\'t match the filename (' . $test . ')', 'MediaController');

					clearCache(null, null, 'data');
					$current = escapeshellarg(WWW_ROOT . ltrim($this->params['url']['url'], '/'));
					$correct = escapeshellarg(WWW_ROOT . Router::url(array('id' => $id, 'filename' => $test)));
					$cmd = "ln -s $current $correct";
					exec($cmd);

					$this->log('	redirecting to correct url', 'MediaController');
					return $this->redirect(array('id' => $id, 'filename' => $test));
				}
			}
			if (!$return = $this->Media->cacheImage(null, $size)) {
				header("HTTP/1.0 404 Not Found");
				$this->log('	cacheImage returned false', 'MediaController');
				return $this->_serve($this->__fallback);
			}
			return $this->_serve(WWW_ROOT . $return);
		} elseif ($mode === 'PdfUpload') {
			if (strpos(trim($this->params['url']['url'], '/'), 'files' !== 0)) {
				header("HTTP/1.0 404 Not Found");
				$this->log(' 	Request to serve a PDF from img folder', 'MediaController');
				return;
			}
			if ($name === $filename) {
				$source = escapeshellarg($this->Media->absolutePath());
				$target = escapeshellarg(preg_replace('@[\\/]+@', '/', WWW_ROOT . $this->params['url']['url']));
				$cmd = "ln -s $source $target";
				exec($cmd);
			} else {
				$match = false;
				foreach ($sizeMap as $size => $params) {
					$test = str_replace('.pdf', '_' . $size . '.png', $filename);
					if ($test === $name) {
						$match = true;
						break;
					}
				}
				if (!$match) {
					header("HTTP/1.0 404 Not Found");
					$this->log('	Not a valid image size', 'MediaController');
					return $this->_serve($this->__fallback);
				}
				$source = $this->Media->absolutePath();
				$target = preg_replace('@[\\/]+@', '/', WWW_ROOT . $this->params['url']['url']);
				$this->Media->thumbnailFile($target, $sizeMap[$size][1], $sizeMap[$size][0], $sizeMap[$size][2]);
			}
			return $this->_serve($target);
		}
		header("HTTP/1.0 404 Not Found");
		$this->log('	Unhandled request', 'MediaController');
		return $this->_serve($this->__fallback);
	}

/**
 * serve method
 *
 * @param $target string absolute path to a file to be served
 * @return void
 * @access protected
 */
	function _serve($target) {
		if ($target[0] !== '/') {
			$target = IMAGES . $target;
			$data['cache'] = false;
			$cmd = 'ln -s ' .
				escapeshellarg(IMAGES . $this->__fallback) . ' ' .
				escapeshellarg(WWW_ROOT . ltrim($this->params['url']['url'], '/'));
			exec($cmd);
		}

		$data['id'] = basename($target);
		$data['path']= str_replace(APP, '', dirname($target)) . DS;
		$data['extension'] = array_pop(explode('.', $data['id']));
		$data['name'] = basename($this->params['url']['url']);
		$this->set($data);
		$this->view = 'Media';
		Configure::write('debug', 0);
		$this->render();
	}

/**
 * setSelects method
 *
 * @param mixed $model
 * @return void
 * @access protected
 */
	function _setSelects($model = null) {
		if ($model) {
			$this->Media->bindModel(array(
				'belongsTo' => array(
					$model => array (
						'model' => $model,
						'conditions' => array('Media.model' => $model)
					)
				)
			));
			$this->set('foreignClass', $model);
			$this->set('foreigns', $this->Media->$model->find('list'));
		}
		if (in_array('_setSelects', get_class_methods('AppController'))) {
			parent::_setSelects();
		}
	}
}