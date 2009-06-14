<?php
/**
 * Short description for ticket.php
 *
 * Long description for ticket.php
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
 * Ticket class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Ticket extends AppModel {

/**
 * belongsTo property
 *
 * @var array
 * @access public
 */
	var $belongsTo = array(
		'Raffle',
		'Transaction',
		'User',
	);

/**
 * hasMany property
 *
 * @var array
 * @access public
 */
	var $hasMany = array(
		'Order',
	);
    function reserved_ticket($numberTicket, $idRaffle, $userId) {
		if (!empty($numberTicket)) { // ha introducido un numero
            // Comprobar que existe idraffle
            // Comprobar que el numero introducido está en el rango
            // Todo Ok  Creo transsaccion
            // Asigno al ticket el id transaccion
            // Creo el order y le asigno el id transaccion.
            // Relleno el campo amount que me vendrá dado por el ratio de precio de la rifa.
            // Tablas a modificar: Raffles ( sold_ticket + 1), Tickets ( code, user_id, rafle_id, transaction_id ), Orders (user_id, amount,
            // transaction_id, ¿description?)
            $raffleSearch = $this->Raffle->find(array('id' =>  $idRaffle)); // Accedo mediante  $numberMax['Raffle']['available_tickets']
            $numberMax = $raffleSearch['Raffle']['available_tickets'];
            $price = $raffleSearch['Raffle']['ticket_price'];
            if (!empty($raffleSearch)) { // existe la rifa
                $result = $this->find('count', array('conditions' => array('raffle_id' => $idRaffle, 'code' => $numberTicket, "Ticket.user_id" => null )));
                 if (!$result) {// El numero está libre;
                        if ($this->User->have_money($price)){
                            $this->User->charge_money($price);
                            
                        }
                        //Genero ticket Generoticket($number)
                        //Genero Order  GeneroOrder($ticket)
                        //Modifico Rifa  Modificorifa(vendidos + 1)
                 }               
             }

         }
	}
	
}