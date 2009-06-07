<?php
/* SVN FILE: $Id$ */

/**
 * Short description for mi_form.php
 *
 * Long description for mi_form.php
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2008, Andy Dawson
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright (c) 2008, Andy Dawson
 * @link          www.ad7six.com
 * @package       base
 * @subpackage    base.views.helpers
 * @since         v 1.0
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import('Helper', 'Form');

/**
 * MiFormHelper class
 *
 * @uses          FormHelper
 * @package       base
 * @subpackage    base.views.helpers
 */
class MiFormHelper extends FormHelper {

/**
 * helpers property
 *
 * @var array
 * @access public
 */
	var $helpers = array(
		'Session',
		'Html',
		'MiJavascript',
		'MiHtml',
	);

/**
 * name property
 *
 * @var string 'Form'
 * @access public
 */
	var $name = 'MiForm';

/**
 * construct method
 *
 * @return void
 * @access private
 */
	function __construct() {
		parent::__construct();
		$this->loadConfig();
	}

/**
 * create method
 *
 * Default the form to the current url. add a hidden field for the referer
 *
 * @param mixed $model
 * @param array $options
 * @return void
 * @access public
 */
	function create($model = null, $options = array()) {
		if (!isset($options['url']) && !isset($options['action'])) {
			$options['url'] = '/' . ltrim($this->params['url']['url'], '/');
		}
		$return = parent::create($model, $options);
		$referer = $this->Session->read('referer');
		if (!$referer) {
			$referer = AppController::referer('/', true);
			if (Router::normalize($referer) == Router::normalize(array('admin' => false, 'controller' => 'users', 'action' => 'login'))) {
				$referer = '/';
			}
		}
		$referer = $this->hidden('_App.referer', array('default' => '/' . ltrim($referer, '/')));
		return preg_replace('#</fieldset>#', $referer . '</fieldset>', $return);
	}

/**
 * dateTime method
 *
 * Use an input and the jquery ui datepicker instead
 *
 * Pass $options['selects'] = true to bypass this override
 *
 * @param mixed $fieldName
 * @param string $dateFormat 'DMY'
 * @param string $timeFormat '12'
 * @param mixed $selected null
 * @param array $options array()
 * @param bool $showEmpty true
 * @return void
 * @access public
 */
	function dateTime($fieldName, $dateFormat = 'DMY', $timeFormat = '12', $selected = null, $options = array(), $showEmpty = true) {
		if (!empty($options['selects'])) {
			unset($options['selects']);
			return parent::dateTime($fieldName, $dateFormat, $timeFormat, $selected, $options, $showEmpty);
		}
		$options = $this->_initInputField($fieldName, array_merge(
			array('type' => 'text'), $options
		));
		if (!empty($options['value'])) {
			list($options['value']) = str_replace('-', '/', explode(' ', $options['value']));
		}
		$id = $options['id'];
		$this->MiHtml->css('/js/theme/ui.datepicker', null, null, false, $this->name);
		$this->MiJavascript->link('jquery-ui.datepicker', null, null, false, $this->name);
		$dateFormat = 'yy/mm/dd';
		$this->MiJavascript->codeBlock(
			'$(document).ready(function() {
				$("#' . $id . '")
					.datepicker({
						showOn: \'button\',
						buttonImage: \'' . $this->Html->url('/img/calendar.gif') . '\',
						buttonImageOnly: true,
						dateFormat: \'' . $dateFormat . '\'
					});
			});',
			array('inline' => false)
		);
		if ($dateFormat) {
			return $this->text($fieldName, am($options, array('class' =>  'datepicker')));
		}
		return $this->text($fieldName, am($options, array('class' =>  'datepicker')));
	}

/**
 * input method
 *
 * @param mixed $fieldName
 * @param array $options array()
 * @return void
 * @access public
 */
	function input($fieldName, $options = array()) {
		$view =& ClassRegistry::getObject('view');
		$this->setEntity($fieldName);
		$entity = join('.', $view->entity());

		$defaults = array('before' => null, 'between' => null, 'after' => null);
		$options = array_merge($defaults, $options);

		if (!isset($options['type'])) {
			$options['type'] = 'text';

			if (isset($options['options'])) {
				$options['type'] = 'select';
			} elseif (in_array($this->field(), array('psword', 'passwd', 'password'))) {
				$options['type'] = 'password';
			} elseif (isset($this->fieldset['fields'][$entity])) {
				$fieldDef = $this->fieldset['fields'][$entity];
				$type = $fieldDef['type'];
				$primaryKey = $this->fieldset['key'];
			} elseif (ClassRegistry::isKeySet($this->model())) {
				$model =& ClassRegistry::getObject($this->model());
				$type = $model->getColumnType($this->field());
				$fieldDef = $model->schema();

				if (isset($fieldDef[$this->field()])) {
					$fieldDef = $fieldDef[$this->field()];
				} else {
					$fieldDef = array();
				}
				$primaryKey = $model->primaryKey;
			}

			if (isset($type)) {
				$map = array(
						'string'  => 'text',     'datetime'  => 'datetime',
						'boolean' => 'checkbox', 'timestamp' => 'datetime',
						'text'    => 'textarea', 'time'      => 'time',
						'date'    => 'date',     'float'     => 'text'
						);

				if (isset($this->map[$type])) {
					$options['type'] = $this->map[$type];
				} elseif (isset($map[$type])) {
					$options['type'] = $map[$type];
				}
				if ($this->field() == $primaryKey) {
					$options['type'] = 'hidden';
				}
			}

			if ($this->model() === $this->field()) {
				$options['type'] = 'select';
				if (!isset($options['multiple'])) {
					$options['multiple'] = 'multiple';
				}
			}
		}
		$types = array('text', 'checkbox', 'radio', 'select');

		if (!isset($options['options']) && in_array($options['type'], $types)) {
			$view =& ClassRegistry::getObject('view');
			$varName = Inflector::variable(
					Inflector::pluralize(preg_replace('/_id$/', '', $this->field()))
					);
			$varOptions = $view->getVar($varName);
			if (is_array($varOptions)) {
				if ($options['type'] !== 'radio') {
					$options['type'] = 'select';
				}
				$options['options'] = $varOptions;
			}
		}

		$autoLength = (!array_key_exists('maxlength', $options) && isset($fieldDef['length']));
		if ($autoLength && $options['type'] == 'text') {
			$options['maxlength'] = $fieldDef['length'];
		}
		if ($autoLength && $fieldDef['type'] == 'float') {
			$options['maxlength'] = array_sum(explode(',', $fieldDef['length']))+1;
		}

		$out = '';
		$div = true;
		$divOptions = array('tag' => 'p');

		if (array_key_exists('div', $options)) {
			$div = $options['div'];
			unset($options['div']);
		}

		if (!empty($div)) {
			$divOptions['class'] = 'input';
			$divOptions = $this->addClass($divOptions, $options['type']);
			if (is_string($div)) {
				$divOptions['class'] = $div;
			} elseif (is_array($div)) {
				$divOptions = array_merge($divOptions, $div);
			}
			if (in_array($this->field(), $this->fieldset['validates'])) {
				$divOptions = $this->addClass($divOptions, 'required');
			}
			if (!isset($divOptions['tag'])) {
				$divOptions['tag'] = 'div';
			}
		}

		$label = null;
		if (isset($options['label']) && $options['type'] !== 'radio') {
			$label = $options['label'];
			unset($options['label']);
		}

		if ($options['type'] === 'radio') {
			$label = false;
			if (isset($options['options'])) {
				if (is_array($options['options'])) {
					$radioOptions = $options['options'];
				} else {
					$radioOptions = array($options['options']);
				}
				unset($options['options']);
			}
		}

		if ($label !== false) {
			$labelAttributes = $this->domId(array(), 'for');
			if (in_array($options['type'], array('date', 'datetime'))) {
				$labelAttributes['for'] .= 'Month';
			} else if ($options['type'] === 'time') {
				$labelAttributes['for'] .= 'Hour';
			}

			if (is_array($label)) {
				$labelText = null;
				if (isset($label['text'])) {
					$labelText = $label['text'];
					unset($label['text']);
				}
				$labelAttributes = array_merge($labelAttributes, $label);
			} else {
				$labelText = $label;
			}

			if (isset($options['id'])) {
				$labelAttributes = array_merge($labelAttributes, array('for' => $options['id']));
			}
			$out = $this->label($fieldName, $labelText, $labelAttributes);
		}

		$error = null;
		if (isset($options['error'])) {
			$error = $options['error'];
			unset($options['error']);
		}

		$selected = null;
		if (array_key_exists('selected', $options)) {
			$selected = $options['selected'];
			unset($options['selected']);
		}
		if (isset($options['rows']) || isset($options['cols'])) {
			$options['type'] = 'textarea';
		}

		$empty = false;
		if (isset($options['empty'])) {
			$empty = $options['empty'];
			unset($options['empty']);
		}

		$timeFormat = 12;
		if (isset($options['timeFormat'])) {
			$timeFormat = $options['timeFormat'];
			unset($options['timeFormat']);
		}

		$dateFormat = 'MDY';
		if (isset($options['dateFormat'])) {
			$dateFormat = $options['dateFormat'];
			unset($options['dateFormat']);
		}

		$type	 = $options['type'];
		$before	 = $options['before'];
		$between = $options['between'];
		$after	 = $options['after'];
		unset($options['type'], $options['before'], $options['between'], $options['after']);

		switch ($type) {
			case 'hidden':
				$out = $this->hidden($fieldName, $options);
				unset($divOptions);
				break;
			case 'checkbox':
				// Label first
				$out = $before . $out . $this->checkbox($fieldName, $options) . $between;
				break;
			case 'radio':
				$out = $before . $out . $this->radio($fieldName, $radioOptions, $options) . $between;
				break;
			case 'text':
			case 'password':
				$out = $before . $out . $between . $this->{$type}($fieldName, $options);
				break;
			case 'file':
				$out = $before . $out . $between . $this->file($fieldName, $options);
				break;
			case 'select':
				$options = array_merge(array('options' => array()), $options);
				$list = $options['options'];
				unset($options['options']);
				$out = $before . $out . $between . $this->select(
						$fieldName, $list, $selected, $options, $empty
						);
				break;
			case 'time':
				$out = $before . $out . $between . $this->dateTime(
						$fieldName, null, $timeFormat, $selected, $options, $empty
						);
				break;
			case 'date':
				$out = $before . $out . $between . $this->dateTime(
						$fieldName, $dateFormat, null, $selected, $options, $empty
						);
				break;
			case 'datetime':
				$out = $before . $out . $between . $this->dateTime(
						$fieldName, $dateFormat, $timeFormat, $selected, $options, $empty
						);
				break;
			case 'textarea':
			default:
				$out = $before . $out . $between . $this->textarea($fieldName, array_merge(
							array('cols' => '30', 'rows' => '6'), $options
							));
				break;
		}

		if ($type != 'hidden') {
			$out .= $after;
			if ($error !== false) {
				$errMsg = $this->error($fieldName, $error);
				if ($errMsg) {
					$out .= $errMsg;
					$divOptions = $this->addClass($divOptions, 'error');
				}
			}
		}
		if (isset($divOptions) && isset($divOptions['tag'])) {
			$tag = $divOptions['tag'];
			unset($divOptions['tag']);
			$out = $this->Html->tag($tag, $out, $divOptions);
		}
		return $out;

	}

/**
 * Returns a formatted LABEL element for HTML FORMs.
 *
 * Overriden to refer to field_names.po unless the label is explicitly passed
 *
 * @param string $fieldName This should be "Modelname.fieldname", "Modelname/fieldname" is deprecated
 * @param string $text Text that will appear in the label field.
 * @return string The formatted LABEL element
 */
	function label($fieldName = null, $text = null, $attributes = array()) {
		if (empty($fieldName)) {
			$view = ClassRegistry::getObject('view');
			$fieldName = implode('.', $view->entity());
		}
		if ($text === null) {
			if (strpos($fieldName, '.')) {
				$alias = explode('.', $fieldName);
				if (count($alias == 3)) {
					$alias = $alias[1];
					$replace = $alias[0] . '.' . $alias[1];
				} else {
					$replace = $alias[0];
				}
				$text = str_replace($replace . '.', '', $fieldName);
			} else {
				$view = ClassRegistry::getObject('view');
				$alias = ($view->association) ? $view->association : $view->model;
				$text = $alias . ' ' . $fieldName;
			}
			if (substr($text, -3) == '_id') {
				$text = substr($text, 0, strlen($text) - 3);
			}
			$_text = Inflector::humanize(Inflector::underscore($text));
			$text = __d('field_names', $_text, true);
			if ($_text === $text) {
				$text = str_replace(Inflector::humanize(Inflector::underscore($alias)) . ' ', '', $_text);
			}
		}
		return parent::label($fieldName, $text, $attributes);
	}
}
?>