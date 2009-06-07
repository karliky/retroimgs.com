<?php
/**
 * Short description for transaction.php
 *
 * Long description for transaction.php
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
 * Transaction class
 *
 * @uses          AppModel
 * @package       rifalia
 * @subpackage    rifalia.models
 */
class Transaction extends AppModel
{


    var $valid_amounts = array(
        5, 20, 50, 100, 200
    );
/**
 * belongsTo property
 *
 * @var array
 * @access public
 */
    var $belongsTo = array(
        'PaymentGateway',
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
        'Ticket',
    );


    public function commitMe()
    {
		/**
		* @todo Enclose this into an attomic transaction
		*/
        $this->data['Transaction']['transaction_type'] = 'credited_payment';
        $this->User->addBalance($this->data['Transaction']['amount']);
		$this->save();
		return true; // tmp fake return
    }

    public function beforeSave()
    {
        if(!$this->id){
            $this->data['Transaction']['payment_requested']  = date('Y-m-d h:m:s');
        }
        $this->setDefaults();
        return true;
    }

    public function setDefaults($defaults = array())
    {
        $this->setAmount(empty($defaults['amount']) ? @$this->data['Transaction']['amount'] : $defaults['amount'] );

        $strict_options = array(
            'payment_gateway_id' => 1,
            'transaction_type' => 'payment_request',
            'amount' => $this->data['Transaction']['amount'],
            'description' => sprintf('Rifalia %d', $this->data['Transaction']['amount']),
            'connection_details' => @serialize(@$_REQUEST),
            'authorisation_code' => '',
        );
        $this->data['Transaction'] = array_merge($this->data['Transaction'], array_merge($defaults, $strict_options));
    }

    public function setAmount($amount)
    {
        $this->data['Transaction']['amount'] = in_array($amount, $this->valid_amounts) ? $amount : 50;
    }

    public function validatesProcessorResponse($processor_params)
    {
        // asignamos el comando para la sincronizaci—n de la notificacion
        $sReq = 'cmd=_notify-synch';

        $sTx_token = $processor_params['tx'];
        //asignamos el key que hemos obtenido de paypal en PERFIL->PREFERENCIAS DE PAGO EN EL SITIO WEB -> (Preferencia Ventas)
        $sAuth_token = C_PAYPAL_PDTKEY;
        $sReq .= "&tx=$sTx_token&at=$sAuth_token";

        // post back to PayPal para validar el pago a partir de los datos recibidos as’ nos aseguramos
        $sHeader = "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $sHeader .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $sHeader .= "Content-Length: " . strlen($sReq) . "\r\n\r\n";
        //ABRIMOS LA CONEXION CON PAYPAL
        //$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
        $oFp = fsockopen (C_PAYPAL_URLCOMPRUEBA, C_PAYPAL_URLCOMPRUEBAPUERTO, $errno, $errstr, 100);
        //$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
        // If possible, securely post back to paypal using HTTPS
        // Your PHP server will need to be SSL enabled
        // $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

        if (!$oFp) {
            return false;
            // HTTP ERROR
        } else {
            fputs ($oFp, $sHeader . $sReq);
            // read the body data
            $sRes = '';
            $bHeaderDone = false;
            while (!feof($oFp)) {
                $sLine = fgets ($oFp, 1024);
                if (strcmp($sLine, "\r\n") == 0) {
                    // read the header
                    $bHeaderDone = true;
                }
                else if ($bHeaderDone)
                {
                    // header has been read. now read the contents
                    $sRes .= $sLine;
                }
            }
        }

        fclose ($oFp);
        $result = trim(array_shift(explode("\n", $sRes))) == "SUCCESS";
        $this->data['Transaction']['payment_response'] = date('Y-m-d h:m:s');
        $this->data['Transaction']['transaction_type'] = $result ? 'confirmed_payment' : 'failed_payment';
        $this->save();
        return $result;
    }


            /*
             *
             *  $this->Transaction->setAmount($this->data['Transaction']['amount']);
            $this->Transaction->setDefaults($this->data);
    created 	datetime 			S’ 	NULL 		Navegar los valores distintivos 	Cambiar 	Eliminar 	Primaria 	ònico 	êndice 	Texto completo
    updated
             */

}