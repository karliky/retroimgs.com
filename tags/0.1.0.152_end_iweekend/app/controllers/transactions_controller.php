<?php
/**
 * Short description for transactions_controller.php
 *
 * Long description for transactions_controller.php
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
 * TransactionsController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class TransactionsController extends AppController {


    function index()
    {
        $this->Session->setFlash('Invalid transaction request');
        $this->_back();
    }


    function add()
    {
        $this->set('valid_amounts', $this->Transaction->valid_amounts);
        $this->_setSelects();
    }

    function confirm()
    {
        if (!empty($_POST)) {
            $this->data = $this->Transaction->save(array('amount'=>$_POST['amount_1'], 'user_id'=>$this->Auth->user('id')));
            $this->set('valid_amounts', $this->Transaction->valid_amounts);
            $this->set('transaction_id', $this->Transaction->id);
        }else{
            $this->_back();
        }
    }

    function processor_callback($id)
    {
        $this->Transaction->read(null, $id);
        if($this->Transaction->validatesProcessorResponse($_GET)){
            $this->redirect("success/".$id);
            return;
        }
        $this->redirect('failure/'.$id);
    }

    function success($id)
    {
        $this->Transaction->find('first', array(
                   'conditions' => array('Transaction.id' => $id, 'transaction_type' => 'confirmed_payment')
            ));
        $this->Transaction->read(null, $id);
        if(!$this->Transaction->commitMe()){
            $this->redirect('failure/'.$id);
        }
    }

    function failure($id)
    {
    }

    function cancel($id)
    {

    }
/**
 * admin_multi_add method
 *
 * @return void
 * @access public
 */
    function admin_multi_add() {
        if ($this->data) {
            $data = array();
            foreach ($this->data as $key => $row) {
                if (!is_numeric($key)) {
                    continue;
                }
                $data[$key] = $row;
            }
            if ($this->Transaction->saveAll($data, array('validate' => 'first', 'atomic' => false))) {
                $this->Session->setFlash(sprintf(__('%1$s added', true), $this->name));
                $this->_back();
            } else {
                $this->Session->setFlash(__('Some or all additions did not succeed', true));
            }
        } else {
            $this->data = array(array('Transaction' => $this->Transaction->create()));
            $this->data[0]['Transaction'][$this->Transaction->primaryKey] = null;
        }
        $this->_setSelects();
        $this->render('admin_multi_edit');
    }

/**
 * admin_multi_edit method
 *
 * Allow admins to edit multiple rows at once
 *
 * @return void
 * @access public
 */
    function admin_multi_edit() {
        if ($this->data) {
            $data = array();
            foreach ($this->data as $key => $row) {
                if (!is_numeric($key)) {
                    continue;
                }
                $data[$key] = $row;
            }
            if ($this->Transaction->saveAll($data, array('validate' => 'first'))) {
                $this->Session->setFlash(sprintf(__('%1$s updated', true), $this->name));
            } else {
                $this->Session->setFlash(__('Some or all updates did not succeed', true));
            }
            $this->_setSelects();
        } else {
            $args = func_get_args();
            call_user_func_array(array($this, 'admin_index'), $args);
            array_unshift($this->data, 'dummy');
            unset($this->data[0]);
        }
    }

/**
 * admin_delete method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
    function admin_delete($id) {
        $this->Transaction->id = $id;
        if ($this->Transaction->exists()) {
            $display = $this->Transaction->display($id);
            if ($this->Transaction->del($id)) {
                $this->Session->setFlash(sprintf(__('%1$s %2$s "%3$s" deleted', true), 'Transaction', $id, $display));
            } else {
                $this->Session->setFlash(sprintf(__('Problem deleting %1$s %2$s "%3$s"', true), 'Transaction', $id, $display));
            }
        } else {
            $this->Session->setFlash(sprintf(__('%1$s with id %2$s doesn\'t exist', true), 'Transaction', $id));
        }
        return $this->_back();
    }

/**
 * admin_edit method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
    function admin_edit($id) {
        if ($this->data) {
            if ($this->Transaction->saveAll($this->data)) {
                $display = $this->Transaction->display();
                $this->Session->setFlash(sprintf(__('%1$s "%2$s" updated', true), 'Transaction', $display));
                return $this->_back();
            } else {
                $this->data = $this->Transaction->data;
                $this->Session->setFlash(__('errors in form', true));
            }
        } else {
            $this->data = $this->Transaction->read(null, $id);
        }
        $this->_setSelects();
    }

/**
 * admin_view method
 *
 * @param mixed $id
 * @return void
 * @access public
 */
    function admin_view($id) {
        $this->data = $this->Transaction->read(null, $id);
        if(!$this->data) {
            $this->Session->setFlash(sprintf(__('Invalid %1$s', true), 'Transaction'));
            return $this->_back();
        }
    }

/**
 * admin_index method
 *
 * Use the Filer component to check for POST/GET data to use for searching.
 * An example of how to load a component for one action only
 *
 * @return void
 * @access public
 */
    function admin_index() {
        if (isset($this->SwissArmy)) {
            $conditions = $this->SwissArmy->parseSearchFilter();
        } else {
            $conditions = array();
        }
        if ($conditions) {
            $this->set('filters', $this->Transaction->searchFilterFields());
            $this->set('addFilter', true);
        }
        $this->Transaction->recursive = 1;
        $this->data = $this->paginate($conditions);
        $this->_setSelects();
    }

/**
 * admin_search method
 *
 * @param mixed $term
 * @return void
 * @access public
 */
    function admin_search($term = null) {
        if ($this->data) {
            $term = trim($this->data['Transaction']['query']);
            $url = array(urlencode($term));
            if ($this->data['Transaction']['extended']) {
                $url['extended'] = true;
            }
            $this->redirect($url);
        }
        $request = $_SERVER['REQUEST_URI'];
        $term = trim(str_replace(Router::url(array()), '', $request), '/');
        if (!$term) {
            $this->redirect(array('action' => 'index'));
        }
        $conditions = $this->Transaction->searchConditions($term, isset($this->passedArgs['extended']));
        $this->Session->setFlash(sprintf(__('All transactions matching the term "%1$s"', true),
                Inflector::humanize(Inflector::underscore($this->name)), htmlspecialchars($term)));
        $this->data = $this->paginate($conditions);
        $this->_setSelects();
        $this->render('admin_index');
    }
}