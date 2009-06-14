<?php
	$this->set('pageTitle', __('New Product', true));
?>
<div class="form-container">
<?php
echo $form->create("Product", array('class'=>'cmxform','type' => 'file')); // Default to enable file uploads

echo $form->inputs(array(
	'legend' => false,
	'id',
	'category_id',
	'provider_id',
	'name',
	'short_description',
	'description',
	'commission' => array('size'=>'1', 'label'=> '% de Comision'),
	'price' => array('size'=>'4', 'label'=> 'Precio en euros'),
	'video_url'

));


echo $form->end(__('Submit', true));
$javascript->link('productsAdd', false);
?>


<form action="" method="get" class="cmxform">
	<fieldset>
	<legend>Cálculo del modelo de ingresos</legend>
	<p style="margin:0"><label for="precioVendedor">Precio Vendedor</label>
		<input style="width:150px" type="text" name="precioVendedor" id="precioVendedor"></p>

	<p style="margin:0"><label for="precioVenta">Precio Salida</label>
		<input style="width:150px" type="text" name="precioVenta" id="precioVenta" disabled="disabled"></p>

	<p style="margin:0"><label for="precioPapeleta">Precio Papeleta</label>
		<input style="width:150px" type="text" name="precioPapeleta" id="precioPapeleta"></p>
	<p style="margin:0"><label for="factorMagico">Fáctor Mágico</label>
		<input style="width:150px" type="text" name="factorMagico" id="factorMagico"></p>

	<p style="margin:0"><label for="numPapeletas">Num Papeletas</label>
		<input style="width:150px;font-weight:bold" type="text" name="numPapeletas" id="numPapeletas"disabled="disabled"></p>

	<p style="margin:0"><label for="iva">Iva</label>
		<input style="width:150px" type="text" name="iva" id="iva" disabled="disabled"></p>
	<p style="margin:0"><label for="hacienda">Hacienda</label>
		<input style="width:150px" type="text" name="hacienda" id="hacienda" disabled="disabled"></p>
	<p style="margin:0"><label for="paypal">paypal</label>
		<input style="width:150px" type="text" name="paypal" id="paypal" disabled="disabled"><input style="width:45px" type="text" name="paypalpc" id="paypalpc" value="3">%</p>
	<p style="margin:0"><label for="notario">notario</label>
		<input style="width:150px" type="text" name="notario" id="notario" disabled="disabled"> <input style="width:45px" type="text" name="notariopc" id="notariopc" value="4">%</p>
	<p style="margin:0"><label for="rifalia">margen rifalia</label>
		<input style="width:150px" type="text" name="rifalia" id="rifalia" disabled="disabled"><input style="width:45px" type="text" name="margenrifalia" id="margenrifalia" value="15">%</p>

	<p style="margin:0"><label for="ingsincargas">ingreso sin cargas</label>
		<input style="width:150px" type="text" name="ingsincargas" id="ingsincargas" disabled="disabled"></p>
	<p style="margin:0"><label for="benefadicio">bºadicional</label>
		<input style="width:150px" type="text" name="benefadicio" id="benefadicio" disabled="disabled">
		<span id="warnMsg" style="color:red;display:none">Ojo! no este producto no sale rentable</span>
		<span id="warnMsgOK" style="color:green;display:none">Ok!, adelante operación rentable.</span>
		</p>
	</fieldset>
</form>
<?php


$menu->settings(__('Options', true), array());
$menu->add(array(
	array('title' => __('New Product', true), 'url' => array('action' => 'add')),
	array('title' => __('Add Many Products', true), 'url' => array('action' => 'multi_add')),
	array('title' => __('Edit These Products', true), 'url' => am($this->passedArgs, array('action' => 'multi_edit')))
));








?></div>