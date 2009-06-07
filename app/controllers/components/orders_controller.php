<?php
class OrdersController extends AppController {

/**
 * name property
 *
 * @var string 'Orders'
 * @access private
 */
	var $name = 'Orders';

    function generateOrder($id_ticket, $price, $idUser){
        $aOrder = array('user_id' => $idUser, 'amount' => $price, "ticket_id" => $id_ticket, "description" => "quien me dejo pilotar esto madre mia");
        $this->Order->save($aOrder);
        return $this->Order->getLastInsertID();
    }
}

}
?>
