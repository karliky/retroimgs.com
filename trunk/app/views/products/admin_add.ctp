<?php
	$this->set('pageTitle', __('A�adir Producto', true));
?>
<div class="form-container">
<?php
echo $form->create("Product", array('class'=>'cmxform','type' => 'file')); // Default to enable file uploads

echo $form->inputs(array(
	'legend' => "Añadir producto",
	'id',
	'category_id',
	'provider_id',
	'name',
	'short_description',
	'description',
	'commission',
	'price',
	'video_url',
));


echo $form->end(__('Submit', true));
$javascript->link('productsAdd', false);
?>

<form action="" method="get" class="cmxform">
	<fieldset>
	<legend>Cálculo del modelo de ingresos</legend>
	<p><label for="precioVendedor">Precio Vendedor</label>
		<input type="text" name="precioVendedor" id="precioVendedor"></p>

	<p><label for="precioVenta">Precio Salida</label>
		<input type="text" name="precioVenta" id="precioVenta" disabled="disabled"></p>

	<p><label for="precioPapeleta">Precio Papeleta</label>
		<input type="text" name="precioPapeleta" id="precioPapeleta"></p>
	<p><label for="factorMagico">Fáctor Mágico</label>
		<input type="text" name="factorMagico" id="factorMagico"></p>

	<p><label for="numPapeletas">Num Papeletas</label>
		<input type="text" name="numPapeletas" id="numPapeletas" style="font-weight:bold" disabled="disabled"></p>

	<p><label for="iva">Iva</label>
		<input type="text" name="iva" id="iva" disabled="disabled"></p>
	<p><label for="hacienda">Hacienda</label>
		<input type="text" name="hacienda" id="hacienda" disabled="disabled"></p>
	<p><label for="paypal">paypal</label>
		<input type="text" name="paypal" id="paypal" disabled="disabled"><input style="width:30px" type="text" name="paypalpc" id="paypalpc" value="3.5">%</p>
	<p><label for="notario">notario</label>
		<input type="text" name="notario" id="notario" disabled="disabled"> <input style="width:30px" type="text" name="notariopc" id="notariopc" value="4">%</p>
	<p><label for="rifalia">margen rifalia</label>
		<input type="text" name="rifalia" id="rifalia" disabled="disabled"><input style="width:30px" type="text" name="margenrifalia" id="margenrifalia" value="15">%</p>

	<p><label for="ingsincargas">ingreso sin cargas</label>
		<input type="text" name="ingsincargas" id="ingsincargas" disabled="disabled"></p>
	<p><label for="benefadicio">bºadicional</label>
		<input type="text" name="benefadicio" id="benefadicio" disabled="disabled">
		<span id="warnMsg" style="color:red;display:none">Ojo! no este producto no sale rentable</span>
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