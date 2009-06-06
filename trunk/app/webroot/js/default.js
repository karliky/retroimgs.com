/* SVN FILE: $Id$ */

/*!
 * default.js scripts for the default layout
 *
 * @package       base
 * @copyright     Copyright (c) 2008, Andy Dawson
 * @link          www.ad7six.com
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
$(function() {

/* Toggle Menu */
	$('div#hoverMenu').append('<a class="menuToggle" href="#">' + __("Full Screen View") + '</a>');
	var contentWidth = $('div#content').css('width');
	var contentMaxWidth = $('div#content').css('max-width');
	var bodyWidth = $('body').css('width');
	$('a.menuToggle').click().toggle(function() {
			$('div#sideBar').hide();
			$('div#content').css('width', '99%');
			$('div#content').css('max-width', '99%');
			$('body').css('width', '99%');
			$(this).text(__('Normal View'));
			return false;
		}, function() {
			$('div#sideBar').show();
			$(this).text(__('Full Screen View'));
			$('div#content').css('width', contentWidth);
			$('div#content').css('max-width', contentMaxWidth);
			$('body').css('width', bodyWidth);
			return false;
	});

/*
 $('input').searchField();
 */

/* sidebar forms submit by ajax Version 1 */
	function bindForms(base) {
		$(base).find('form').each(function() {
			ajaxSubmit(this);
		});
	}
	function ajaxSubmit(elem) {
		$(elem).ajaxForm({
			success: function(r) {
				var p = $(elem).parent();
				p.html(r);
				bindForms(p);
			}
		});
	}
	bindForms($('#sideBar'));

/* sidebar forms submit by ajax Version 2
$.fn.ajaxSubmit = function() {
	$(this).ajaxForm({
		success: function(r) {
			p = $(this).parent();
			p.html(r);
			p.bindForms();
		}
	});
};
$.fn.bindForms = function() {
	$(this).find('form').each(function() {
		$(this).ajaxSubmit();
	});
}
$('#sideBar').bindForms();
*/
});
