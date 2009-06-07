<?php
/**
 * Short description for tickets_controller.php
 *
 * Long description for tickets_controller.php
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
 * TicketsController class
 *
 * @uses          AppController
 * @package       rifalia
 * @subpackage    rifalia.controllers
 */
class TicketsController extends AppController {

/**
 * scaffold property
 *
 * @var array
 * @access public
 */
	var $scaffold = array('index', 'add', 'edit', 'delete');

/**
 * name property
 *
 * @var string 'Tickets'
 * @access public
 */
	var $name = 'Tickets';

    function reserved_ticket($count, $numberTicket, $idRaffle, $userId) {

       if ($count != 1){
            for ($i=1; $i < $count+1;$i++){
                
            }

       }else{
            if (!empty($numberTicket)) { // ha introducido un numero
                // Comprobar que existe idraffle
                // Comprobar que el numero introducido está en el rango
                // Todo Ok  Creo transsaccion
                // Asigno al ticket el id transaccion
                // Creo el order y le asigno el id transaccion.
                // Relleno el campo amount que me vendrá dado por el ratio de precio de la rifa.
                // Tablas a modificar: Raffles ( sold_ticket + 1), Tickets ( code, user_id, rafle_id, transaction_id ), Orders (user_id, amount,
                // transaction_id, ¿description?)
                $raffleSearch = $this->Ticket->Raffle->find(array('Raffle_id' =>  $idRaffle)); // Accedo mediante  $numberMax['Raffle']['available_tickets']
                $price = $raffleSearch['Raffle']['ticket_price'];
                if (!empty($raffleSearch)) { // existe la rifa
                    $result = $this->find('count', array('conditions' => array('raffle_id' => $idRaffle, 'code' => $numberTicket, "Ticket.user_id" => null )));
                     if (!$result) {// El numero está libre;
                         if ($this->User->haveMoney($price)){
                                $order = $this->Order->generateOrder($result['Ticket']['id'], $price, $userId);
                                $this->User->charge_money($price);
                                $this->Raffle->ticketBought($idRaffle, 1);
                         }else{
                           $this->Session->setFlash('No dispones de suficiente saldo.');
                         }
                            //Genero ticket Generoticket($number)
                            //Genero Order  GeneroOrder($ticket)
                            //Modifico Rifa  Modificorifa(vendidos + 1)
                     }else{
                         $this->Session->setFlash('El numero no esta disponible');
                     }
                 }else{
                      $this->Session->setFlash('La rifa no existe');
                 }

             }else{
                 $this->Session->setFlash('No has introducido un numero de Rifa');
             }
       }
	}
}