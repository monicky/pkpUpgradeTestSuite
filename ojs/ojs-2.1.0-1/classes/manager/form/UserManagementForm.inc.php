<?php

/**
 * UserManagementForm.inc.php
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package manager.form
 *
 * Form for journal managers to edit user profiles.
 *
 * $Id: UserManagementForm.inc.php,v 1.28 2006/01/06 19:12:29 alec Exp $
 */

import('form.Form');

class UserManagementForm extends Form {

	/** The ID of the user being edited */
	var $userId;

	/** @var boolean Include a user's working languages in their profile */
	var $profileLocalesEnabled;
	
	/**
	 * Constructor.
	 */
	function UserManagementForm($userId = null) {
		parent::Form('manager/people/userProfileForm.tpl');
		
		$this->userId = isset($userId) ? (int) $userId : null;
		$site = &Request::getSite();
		$this->profileLocalesEnabled = $site->getProfileLocalesEnabled();
		
		// Validation checks for this form
		if ($userId == null) {
			$this->addCheck(new FormValidator($this, 'username', 'required', 'user.profile.form.usernameRequired'));
			$this->addCheck(new FormValidatorCustom($this, 'username', 'required', 'user.register.form.usernameExists', array(DAORegistry::getDAO('UserDAO'), 'userExistsByUsername'), array($this->userId, true), true));
			$this->addCheck(new FormValidatorAlphaNum($this, 'username', 'required', 'user.register.form.usernameAlphaNumeric'));
			$this->addCheck(new FormValidator($this, 'password', 'required', 'user.profile.form.passwordRequired'));
			$this->addCheck(new FormValidatorLength($this, 'password', 'required', 'user.register.form.passwordLengthTooShort', '>=', $site->getMinPasswordLength()));
			$this->addCheck(new FormValidatorCustom($this, 'password', 'required', 'user.register.form.passwordsDoNotMatch', create_function('$password,$form', 'return $password == $form->getData(\'password2\');'), array(&$this)));
		} else {
			$this->addCheck(new FormValidatorLength($this, 'password', 'optional', 'user.register.form.passwordLengthTooShort', '>=', $site->getMinPasswordLength()));
			$this->addCheck(new FormValidatorCustom($this, 'password', 'optional', 'user.register.form.passwordsDoNotMatch', create_function('$password,$form', 'return $password == $form->getData(\'password2\');'), array(&$this)));
		}
		$this->addCheck(new FormValidator($this, 'firstName', 'required', 'user.profile.form.firstNameRequired'));
		$this->addCheck(new FormValidator($this, 'lastName', 'required', 'user.profile.form.lastNameRequired'));
		$this->addCheck(new FormValidatorEmail($this, 'email', 'required', 'user.profile.form.emailRequired'));
		$this->addCheck(new FormValidatorCustom($this, 'email', 'required', 'user.register.form.emailExists', array(DAORegistry::getDAO('UserDAO'), 'userExistsByEmail'), array($this->userId, true), true));
	}
	
	/**
	 * Display the form.
	 */
	function display() {
		$templateMgr = &TemplateManager::getManager();
		$site = &Request::getSite();
		$templateMgr->assign('minPasswordLength', $site->getMinPasswordLength());
		$templateMgr->assign('userId', $this->userId);
		if (isset($this->userId)) {
			$userDao = &DAORegistry::getDAO('UserDAO');
			$user = &$userDao->getUser($this->userId);
			$templateMgr->assign('username', $user->getUsername());
			$helpTopicId = 'journal.users.index';
		} else {
			$helpTopicId = 'journal.users.createNewUser';
		}
		$templateMgr->assign('roleOptions',
			array(
				'' => 'manager.people.doNotEnroll',
				'manager' => 'user.role.manager',
				'editor' => 'user.role.editor',
				'sectionEditor' => 'user.role.sectionEditor',
				'layoutEditor' => 'user.role.layoutEditor',
				'reviewer' => 'user.role.reviewer',
				'copyeditor' => 'user.role.copyeditor',
				'proofreader' => 'user.role.proofreader',
				'author' => 'user.role.author',
				'reader' => 'user.role.reader',
				'subscriptionManager' => 'user.role.subscriptionManager'
			)
		);
		$templateMgr->assign('profileLocalesEnabled', $this->profileLocalesEnabled);
		if ($this->profileLocalesEnabled) {
			$site = &Request::getSite();
			$templateMgr->assign('availableLocales', $site->getSupportedLocaleNames());
		}
		$templateMgr->assign('helpTopicId', $helpTopicId);

		$countryDao =& DAORegistry::getDAO('CountryDAO');
		$countries =& $countryDao->getCountries();
		$templateMgr->assign_by_ref('countries', $countries);
		
		$authDao = &DAORegistry::getDAO('AuthSourceDAO');
		$authSources = &$authDao->getSources();
		$authSourceOptions = array();
		foreach ($authSources->toArray() as $auth) {
			$authSourceOptions[$auth->getAuthId()] = $auth->getTitle();
		}
		if (!empty($authSourceOptions)) {
			$templateMgr->assign('authSourceOptions', $authSourceOptions);
		}
		parent::display();
	}
	
	/**
	 * Initialize form data from current user profile.
	 */
	function initData() {
		if (isset($this->userId)) {
			$userDao = &DAORegistry::getDAO('UserDAO');
			$user = &$userDao->getUser($this->userId);
			
			if ($user != null) {
				$this->_data = array(
					'authId' => $user->getAuthId(),
					'username' => $user->getUsername(),
					'firstName' => $user->getFirstName(),
					'middleName' => $user->getMiddleName(),
					'lastName' => $user->getLastName(),
					'initials' => $user->getInitials(),
					'affiliation' => $user->getAffiliation(),
					'email' => $user->getEmail(),
					'phone' => $user->getPhone(),
					'fax' => $user->getFax(),
					'mailingAddress' => $user->getMailingAddress(),
					'country' => $user->getCountry(),
					'biography' => $user->getBiography(),
					'interests' => $user->getInterests(),
					'userLocales' => $user->getLocales()
				);

			} else {
				$this->userId = null;
			}
		}
		if (!isset($this->userId)) {
			$roleDao = &DAORegistry::getDAO('RoleDAO');
			$roleId = Request::getUserVar('roleId');
			$roleSymbolic = $roleDao->getRolePath($roleId);

			$this->_data = array(
				'enrollAs' => array($roleSymbolic)
			);
		}
	}
	
	/**
	 * Assign form data to user-submitted data.
	 */
	function readInputData() {
		$this->readUserVars(array('authId', 'enrollAs', 'password', 'password2', 'firstName', 'middleName', 'lastName', 'initials', 'affiliation', 'email', 'phone', 'fax', 'mailingAddress', 'country', 'biography', 'interests', 'userLocales', 'generatePassword', 'sendNotify', 'mustChangePassword'));
		if ($this->userId == null) {
			$this->readUserVars(array('username'));
		}
		
		if ($this->getData('userLocales') == null || !is_array($this->getData('userLocales'))) {
			$this->setData('userLocales', array());
		}
		
		if ($this->getData('username') != null) {
			// Usernames must be lowercase
			$this->setData('username', strtolower($this->getData('username')));
		}
	}
	
	/**
	 * Register a new user.
	 */
	function execute() {
		$userDao = &DAORegistry::getDAO('UserDAO');
		$journal = &Request::getJournal();
		
		if (isset($this->userId)) {
			$user = &$userDao->getUser($this->userId);
		}
		
		if (!isset($user)) {
			$user = &new User();
		}
		
		$user->setFirstName($this->getData('firstName'));
		$user->setMiddleName($this->getData('middleName'));
		$user->setLastName($this->getData('lastName'));
		$user->setInitials($this->getData('initials'));
		$user->setAffiliation($this->getData('affiliation'));
		$user->setEmail($this->getData('email'));
		$user->setPhone($this->getData('phone'));
		$user->setFax($this->getData('fax'));
		$user->setMailingAddress($this->getData('mailingAddress'));
		$user->setCountry($this->getData('country'));
		$user->setBiography($this->getData('biography'));
		$user->setInterests($this->getData('interests'));
		$user->setMustChangePassword($this->getData('mustChangePassword') ? 1 : 0);
		$user->setAuthId((int) $this->getData('authId'));
		
		if ($this->profileLocalesEnabled) {
			$site = &Request::getSite();
			$availableLocales = $site->getSupportedLocales();
			
			$locales = array();
			foreach ($this->getData('userLocales') as $locale) {
				if (Locale::isLocaleValid($locale) && in_array($locale, $availableLocales)) {
					array_push($locales, $locale);
				}
			}
			$user->setLocales($locales);
		}
		
		if ($user->getAuthId()) {
			$authDao = &DAORegistry::getDAO('AuthSourceDAO');
			$auth = &$authDao->getPlugin($user->getAuthId());
		}
		
		if ($user->getUserId() != null) {
			if ($this->getData('password') !== '') {
				if (isset($auth)) {
					$auth->doSetUserPassword($user->getUsername(), $this->getData('password'));
					$user->setPassword(Validation::encryptCredentials($user->getUserId(), Validation::generatePassword())); // Used for PW reset hash only
				} else {
					$user->setPassword(Validation::encryptCredentials($user->getUsername(), $this->getData('password')));
				}
			}
			
			if (isset($auth)) {
				// FIXME Should try to create user here too?
				$auth->doSetUserInfo($user);
			}
			
			$userDao->updateUser($user);
		
		} else {
			$user->setUsername($this->getData('username'));
			if ($this->getData('generatePassword')) {
				$password = Validation::generatePassword();
				$sendNotify = true;
			} else {
				$password = $this->getData('password');
				$sendNotify = $this->getData('sendNotify');
			}
			
			if (isset($auth)) {
				$user->setPassword($password);
				// FIXME Check result and handle failures
				$auth->doCreateUser($user);
				$user->setAuthId($auth->authId);				$user->setPassword(Validation::encryptCredentials($user->getUserId(), Validation::generatePassword())); // Used for PW reset hash only
			} else {
				$user->setPassword(Validation::encryptCredentials($this->getData('username'), $password));
			}

			$user->setDateRegistered(Core::getCurrentDate());
			$userId = $userDao->insertUser($user);
			
			if (!empty($this->_data['enrollAs'])) {
				foreach ($this->getData('enrollAs') as $roleName) {
					// Enroll new user into an initial role
					$roleDao = &DAORegistry::getDAO('RoleDAO');
					$roleId = $roleDao->getRoleIdFromPath($roleName);
					if ($roleId != null) {
						$role = &new Role();
						$role->setJournalId($journal->getJournalId());
						$role->setUserId($userId);
						$role->setRoleId($roleId);
						$roleDao->insertRole($role);
					}
				}
			}
		
			if ($sendNotify) {
				// Send welcome email to user
				import('mail.MailTemplate');
				$mail = &new MailTemplate('USER_REGISTER');
				$mail->setFrom($journal->getSetting('contactEmail'), $journal->getSetting('contactName'));
				$mail->assignParams(array('username' => $this->getData('username'), 'password' => $password));
				$mail->addRecipient($user->getEmail(), $user->getFullName());
				$mail->send();
			}
		}
	}
	
}

?>
