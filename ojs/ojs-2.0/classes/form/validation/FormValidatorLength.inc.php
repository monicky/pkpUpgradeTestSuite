<?php

/**
 * FormValidatorLength.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package form.validation
 *
 * Form validation check that checks if a field's length meets certain requirements.
 *
 * $Id: FormValidatorLength.inc.php,v 1.3 2005/04/25 20:38:11 alec Exp $
 */

import ('form.validation.FormValidator');

class FormValidatorLength extends FormValidator {

	/** @var string comparator to use (== | != | < | > | <= | >= ) */
	var $comparator;

	/** @var int length to compare with */
	var $length;
	
	/**
	 * Constructor.
	 * @see FormValidator::FormValidator()
	 * @param $comparator
	 * @param $length
	 */
	function FormValidatorLength($form, $field, $type, $message, $comparator, $length) {
		parent::FormValidator(&$form, $field, $type, $message);
		$this->comparator = $comparator;
		$this->length = $length;
	}
	
	/**
	 * Check if field value is valid.
	 * Value is valid if it is empty and optional or meets the specified length requirements.
	 * @return boolean
	 */
	function isValid() {
		if ($this->isEmptyAndOptional()) {
			return true;
			
		} else {
			$length = String::strlen(trim($this->form->getData($this->field)));
			switch ($this->comparator) {
				case '==':
					return $length == $this->length;
				case '!=':
					return $length != $this->length;
				case '<':
					return $length < $this->length;
				case '>':
					return $length > $this->length;
				case '<=':
					return $length <= $this->length;
				case '>=':
					return $length >= $this->length;
			}
			return false;
		}
	}
	
}

?>
