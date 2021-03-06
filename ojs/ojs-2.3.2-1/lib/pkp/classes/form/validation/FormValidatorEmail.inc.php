<?php

/**
 * @file classes/form/validation/FormValidatorEmail.inc.php
 *
 * Copyright (c) 2000-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class FormValidatorEmail
 * @ingroup form_validation
 * @see FormValidator
 *
 * @brief Form validation check for email addresses.
 */

// $Id: FormValidatorEmail.inc.php,v 1.5 2009/08/11 21:59:55 mj Exp $


import('form.validation.FormValidatorRegExp');

class FormValidatorEmail extends FormValidatorRegExp {
	function getRegexp() {
		return '/^' . PCRE_EMAIL_ADDRESS . '$/i';
	}

	/**
	 * Constructor.
	 * @see FormValidatorRegExp::FormValidatorRegExp()
	 */
	function FormValidatorEmail(&$form, $field, $type, $message) {
		parent::FormValidatorRegExp($form, $field, $type, $message, FormValidatorEmail::getRegexp());
	}
}

?>
