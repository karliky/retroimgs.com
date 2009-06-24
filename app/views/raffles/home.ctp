<?php
$this->layout = 'home';
echo $this->element('featured', array('data'=> $featured));
?>
<div id="resto_productos">
<?php
foreach($data as $row) {
	echo $this->element('item', array('data' => $row));
}
?>
</div>