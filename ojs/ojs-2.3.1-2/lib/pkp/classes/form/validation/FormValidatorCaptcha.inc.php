<?php

/**
 * @file classes/form/validation/FormValidatorCaptcha.inc.php
 *
 * Copyright (c) 2000-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class FormValidatorCaptcha
 * @ingroup form_validation
 *
 * @brief Form validation check captcha values.
 */

// $Id: FormValidatorCaptcha.inc.php,v 1.4 2009/05/13 16:35:48 asmecher Exp $


class FormValidatorCaptcha extends FormValidator {
	var $captchaIdField;

	/**
	 * Constructor.
	 * @param $form object
	 * @param $field string Name of captcha value submitted by user
	 * @param $captchaIdField string Name of captcha ID field
	 * @param $message string Key of message to display on mismatch
	 */
	function FormValidatorCaptcha(&$form, $field, $captchaIdField, $message) {
		parent::FormValidator($form, $field, 'required', $message);
		$this->captchaIdField = $captchaIdField;
	}

	/**
	 * Determine whether or not the form meets this Captcha constraint.
	 * @return boolean
	 */
	function isValid() {
		$captchaDao =& DAORegistry::getDAO('CaptchaDAO');
		$captchaId = $this->form->getData($this->captchaIdField);
		$captchaValue = $this->form->getData($this->field);
		$captcha =& $captchaDao->getCaptcha($captchaId);
		if ($captcha && $captcha->getValue() === $captchaValue) {
			$captchaDao->deleteObject($captcha);
			return true;
		}
		return false;
	}
}

?>
