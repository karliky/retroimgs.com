<script language="javascript">
    function calculaIVA(p_dIVA) {
        $("#tax_cart").attr("value",p_dIVA * 0.16);
      //var oSelected = document.getElementById("option_"+p_dIVA);
      //oSelected.value =
    }

</script>

<?php

//change constant values for relase versions


$this->set('pageTitle', __('New Transaction', true));

?>
<div class="form-container">
    <br />
    <p>
        ¿Cuánto saldo quieres añadir a tu cuenta en Rifalia.com?
    </p>
    <form action="confirm" method="post" name="pago" id="pago_paypal" >

        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="upload" value="1" />

        <input type="hidden" name="item_name_1" value="Compra de credito para Rifalia" />
        <input type="hidden" name="charset" value="utf8">

        <?php foreach($valid_amounts as $k=>$valid_amount){ ?>

        <p>
        <input id="option_<?php echo $valid_amount ?>" type="radio" name="amount_1"
        value="<?php echo $valid_amount; ?>" <?php if($k==2){echo 'checked="checked"';} ?> />

        <?php /*
         * To add IVA
         * onclick="javascript:calculaIVA(<?php echo $valid_amount; ?>)"
         */?>

        <label><?php echo $valid_amount; ?> €</label>
        </p>

        <?php } ?>


        <input type="hidden" name="quantity_1" value="1" />

        <input type="hidden" name="currency_code" value="EUR" />
        <input type="hidden" name="lc" value="ES" />


        <input type="hidden" name="no_shipping" value="1" />
        <input type="hidden" name="rm" value="2" />

        <input type="submit" value="Realizar Pago" />
    </form>
    <br />
</div>