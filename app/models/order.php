<?php
/**
 * Short description for order.php
 *
 * Long description for order.php
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
 * Order class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Order extends AppModel {

/**
 * belongsTo property
 *
 * @var array
 * @access public
 */
	var $belongsTo = array(
		'Transaction',
		'Ticket',
		'User',
	);

      function generateOrder($id_ticket, $price, $idUser){
        $aOrder = array('user_id' => $idUser, 'amount' => $price, "ticket_id" => $id_ticket, "description" => "quien me dejo pilotar esto madre mia");
        $this->save($aOrder);
        return $this->getLastInsertID();
    }
}