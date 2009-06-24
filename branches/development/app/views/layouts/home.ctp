<?php /* SVN FILE: $Id$ */
echo $html->docType('xhtml-trans'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $html->charset(); ?>
<title><?php echo htmlspecialchars($title_for_layout); ?></title>
<?php
echo $html->meta('icon');
$stripNamed = array(
	'page' => false,
	'fields' => false,
	'order' => false,
	'limit' => false,
	'recursive' => false,
	'sort' => false,
	'direction' => false,
	'step' => false,
);
echo $html->meta('canonical', am($this->passedArgs, $stripNamed));
echo $html->css(array(
	'default',
	'/js/theme/ui.all',
	'form'
), null, null, false);
echo $html->css();

if (isset ($javascript)) {
	echo $javascript->link(array(
		'jquery.searchField', 'jquery.blockUI',
		'jquery.mi_dialogs',
		'default',
	), false);
	$locale = I18n::getInstance()->l10n->locale;
	if ($locale !== 'eng' && file_exists(APP . 'locale' . DS . $locale)) {
		echo $javascript->link('i18n.' . $locale, false, 'localization');
	}
}
echo $scripts_for_layout;
?>
</head>
<body class="<?php echo $this->action; ?>">
	<div id="contenedor">
		<?php echo $this->element('header'); ?>
		<div id="contenido">
			<div id="contenido_iz"><?php
				echo $this->element('flash');
				echo $content_for_layout;
			?></div>
			<div id="contenido_der">
				<p class="boton-rifa-big"><a href="/users/register" title="Crea tu propia rifa">Crea tu propia rifa</a></p>
				<?php echo $this->element('sidebar-a'); ?>
				<?php echo $this->element('sidebar-b'); ?>
			?></div>
		<?php echo $this->element('footer'); ?>
	</div>
<?php echo $javascript->link(); ?>
</body>
</html>