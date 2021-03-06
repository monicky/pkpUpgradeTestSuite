<?php

/**
 * JournalSetupForm.inc.php
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package manager.form.setup
 *
 * Base class for journal setup forms.
 *
 * $Id: JournalSetupForm.inc.php,v 1.11 2006/06/12 23:25:52 alec Exp $
 */

import("manager.form.setup.JournalSetupForm");
import('form.Form');

class JournalSetupForm extends Form {
	var $step;
	var $settings;
	
	/**
	 * Constructor.
	 * @param $step the step number
	 * @param $settings an associative array with the setting names as keys and associated types as values
	 */
	function JournalSetupForm($step, $settings) {
		parent::Form(sprintf('manager/setup/step%d.tpl', $step));
		$this->step = $step;
		$this->settings = $settings;
	}
	
	/**
	 * Display the form.
	 */
	function display() {
		$templateMgr = &TemplateManager::getManager();
		$templateMgr->assign('setupStep', $this->step);
		$templateMgr->assign('helpTopicId', 'journal.managementPages.setup');
		parent::display();
	}
	
	/**
	 * Initialize data from current settings.
	 */
	function initData() {
		$journal = &Request::getJournal();
		$this->_data = $journal->getSettings();
	}
	
	/**
	 * Read user input.
	 */
	function readInputData() {		
		$this->readUserVars(array_keys($this->settings));
	}
	
	/**
	 * Save modified settings.
	 */
	function execute() {
		$journal = &Request::getJournal();
		$settingsDao = &DAORegistry::getDAO('JournalSettingsDAO');
		
		foreach ($this->_data as $name => $value) {
			if (isset($this->settings[$name])) {
				$settingsDao->updateSetting(
					$journal->getJournalId(),
					$name,
					$value,
					$this->settings[$name]
				);
			}
		}
	}
}

?>
