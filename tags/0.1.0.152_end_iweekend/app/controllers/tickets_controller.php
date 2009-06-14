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
         $raffleSearch = $this->Ticket->Raffle->find(array('Raffle.id' =>  $idRaffle)); // Accedo mediante  $numberMax['Raffle']['available_tickets']
         $price = $raffleSearch['Raffle']['ticket_price'];
         $total_cost = $price * $count;
         if (!empty($raffleSearch)) { // existe la rifa
                   if ($count != 1){
                        if ($this->Ticket->User->haveMoney($userId,$total_cost)){
                                for ($i=1; $i < $count+1;$i++){
                                         $id_result = $this->Ticket->find(array('raffle_id' => $idRaffle, "Ticket.user_id" => null), "code", array('rand()'));
                                         $order = $this->Ticket->Order->generateOrder($id_result['Ticket']['id'], $price, $userId);
                                         $this->Ticket->User->chargeMoney($userId, $price);
                                         $this->saveTicket($id_result['Ticket']['id'], $userId);
                                }
                                $this->Ticket->Raffle->ticketsBought($idRaffle, $count);
                                $this->Session->setFlash('Reserva realizada con exito ¡¡ Munchisima suerte campeón tu lo mereces !!.');
                        }else{
                             $this->Session->setFlash('No dispones de suficiente saldo.');
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

                                $result = $this->Ticket->find(array('code' => $numberTicket, "Ticket.user_id" => null ));
                              if ($result['Ticket']['id']!= null) {// El numero está libre;
                                     if ($this->Ticket->User->haveMoney($userId, $price)){
                                            $order = $this->Ticket->Order->generateOrder($result['Ticket']['id'], $price, $userId);
                                            $this->Ticket->User->chargeMoney($userId, $price);
                                            $this->Ticket->Raffle->ticketsBought($idRaffle, 1);
                                            $this->saveTicket($result['Ticket']['id'], $userId);
                                            $this->Session->setFlash('Reserva realizada con exito del numero '.$numberTicket.' ¡¡ Munchisima suerte campeón tu lo mereces !!');
                                     }else{
                                       $this->Session->setFlash('No dispones de suficiente saldo racano pon pasta.');
                                     }
                                        //Genero ticket Generoticket($number)
                                        //Genero Order  GeneroOrder($ticket)
                                        //Modifico Rifa  Modificorifa(vendidos + 1)
                                 }else{
                                     $this->Session->setFlash('El numero no esta disponible prueba otro listillo');
                                 }

                         }else{
                             $this->Session->setFlash('No has introducido un numero te crees que me chupo el dedo');
                         }
                   }
         }else{
                  $this->Session->setFlash('La rifa no existe');
         }
	}
    function saveTicket($id_ticket, $id_user){
               $this->Ticket->updateAll(array('user_id' => $id_user), array('Ticket.id'=> $id_ticket));
    }
}