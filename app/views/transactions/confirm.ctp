<script language="javascript">
    function calculaIVA(p_dIVA) {
        $("#tax_cart").attr("value",p_dIVA * 0.16);
      //var oSelected = document.getElementById("option_"+p_dIVA);
      //oSelected.value =
    }

</script>

<?php

// $data['Transaction']['id']
// $data['Transaction']['id']
// $data['Transaction']['id']
// $data['Transaction']['id']
// $data['Transaction']['id']
/*
 *
 *
 *
 *             [amount] => 50
 *
            [user_id] => 2
            [updated] => 2009-06-07 19:56:21
            [created] => 2009-06-07 19:56:21
            [payment_requested] => 2009-06-07 07:06:21
            [payment_gateway_id] => 1
            [transaction_type] => charge
            [description] => Rifalia 50
            [connection_details] => a:17:{s:3:"url";s:20:"transactions/confirm";s:3:"cmd";s:5:"_cart";s:6:"upload";s:1:"1";s:8:"business";s:29:"raurop_1244326013_biz@ono.com";s:11:"item_name_1";s:30:"Compra de credito para Rifalia";s:7:"charset";s:4:"utf8";s:8:"amount_1";s:2:"50";s:10:"quantity_1";s:1:"1";s:13:"currency_code";s:3:"EUR";s:2:"lc";s:2:"ES";s:6:"return";s:39:"http://localhost:8888/paypal/finish.php";s:13:"cancel_return";s:38:"http://localhost:8888/paypal/index.php";s:11:"no_shipping";s:1:"1";s:2:"rm";s:1:"2";s:7:"CAKEPHP";s:32:"515cef023979b6dba4ed0dae9ee7b1b1";s:7:"RIFALIA";s:32:"021ef59da6ee12ee6b55c951017262ec";s:14:"toolbarDisplay";s:4:"none";}
            [authorisation_code] =>

//
//*/
//
//change constant values for relase versions


$this->set('pageTitle', __('New Transaction', true));

?>
<div class="form-container">
    <br />
    <p>
       Confirma tu nuevo saldo Rifalia.com
    </p>
    <p><strong>Quiero aumentar mi saldo en <?php echo $data['Transaction']['amount']; ?> &euro;</strong></p>
    <form action="<?php echo C_PAYPAL_URLSUBMIT ?>" method="post" name="pago" id="pago_paypal" >

        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="upload" value="1" />
        <input type="hidden" name="business" value="<?php echo C_PAYPAL_BUSINESSID ?>" />

        <input type="hidden" name="item_name_1" value="Compra de credito para Rifalia" />
        <input type="hidden" name="charset" value="utf8">

        <input id="amount" type="hidden" name="amount_1"
        value="<?php echo $data['Transaction']['amount']; ?>"/>


        <input type="hidden" name="quantity_1" value="1" />

        <input type="hidden" name="currency_code" value="EUR" />
        <input type="hidden" name="lc" value="ES" />


        <input type="hidden" name="return"
            value="<?php echo C_PAYPAL_BASE_URL.'processor_callback/'.$transaction_id; ?>" />
        <input type="hidden" name="cancel_return" value="<?php echo C_PAYPAL_BASE_URL.'cancel/'.$transaction_id; ?>" />
        <input type="hidden" name="no_shipping" value="1" />
        <input type="hidden" name="rm" value="2" />

        <input type="submit" value="Realizar Pago" />
    </form>
    <br />
</div>