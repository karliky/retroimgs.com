/* SVN FILE: $Id$ */

/*!
 * JavaScript i18n
 *
 * @package       base
 * @author        Matthew Somerville
 * @copyright     ???
 * @link          24ways.org/2007/javascript-internationalisation
 * @license       ???
 */

/**
 * __ method
 *
 * @return void
 * @access protected
 */
function __(s) {
	if (typeof(i18n) != 'undefined' && i18n[s]) {
		return i18n[s];
	}
	return s;
	}

/**
 * sprintf method
 *
 * @return void
 * @access public
 */
function sprintf(s) {
	var bits = s.split('%');
	var out = bits[0];
	var re = /^([ds])(.*)$/;
	for (var i=1; i<bits.length; i++) {
		p = re.exec(bits[i]);
		if (!p || arguments[i] == null) continue;
		if (p[1] == 'd') {
			out += parseInt(arguments[i], 10);
		} else if (p[1] == 's') {
			out += arguments[i];
		}
		out += p[2];
	}
	return out;
}

/**
 * getValue method
 *
 * @return void
 * @access public
 */
function getValue(e) {
	var p = parseInt(document.getElementById(e).value, 10);
	if (!p || p<0) return 0;
	return p;
}

/**
 * pretty_num method
 *
 * @return void
 * @access public
 */
function pretty_num(n) {
	n += '';
	var o = '';
	for (i=n.length; i>3; i-=3) {
		o = i18n.thousands_sep + n.slice(i-3, i) + o;
	}
	o = n.slice(0, i) + o;
	return o;
}

/**
 * pluralise method
 *
 * @return void
 * @access public
 */
function pluralise(s, p, n) {
	if (n != 1) return __(p);
	return __(s);
}
