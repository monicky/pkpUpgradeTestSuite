<?php

/**
 * AdminSettingsHandler.inc.php
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package pages.admin
 *
 * Handle requests for changing site admin settings. 
 *
 * $Id: AdminSettingsHandler.inc.php,v 1.5 2006/06/12 23:26:08 alec Exp $
 */

class AdminSettingsHandler extends AdminHandler {
	
	/**
	 * Display form to modify site settings.
	 */
	function settings() {
		parent::validate();
		parent::setupTemplate(true);
		
		import('admin.form.SiteSettingsForm');

		$settingsForm = &new SiteSettingsForm();
		$settingsForm->initData();
		$settingsForm->display();
	}
	
	/**
	 * Validate and save changes to site settings.
	 */
	function saveSettings() {
		parent::validate();
		parent::setupTemplate(true);
		
		import('admin.form.SiteSettingsForm');
		
		$settingsForm = &new SiteSettingsForm();
		$settingsForm->readInputData();
		
		if ($settingsForm->validate()) {
			$settingsForm->execute();
		
			$templateMgr = &TemplateManager::getManager();
			$templateMgr->assign(array(
				'currentUrl' => Request::url(null, null, 'settings'),
				'pageTitle' => 'admin.siteSettings',
				'message' => 'common.changesSaved',
				'backLink' => Request::url(null, Request::getRequestedPage()),
				'backLinkLabel' => 'admin.siteAdmin'
			));
			$templateMgr->display('common/message.tpl');
			
		} else {
			$settingsForm->display();
		}
	}
	
}

?>
