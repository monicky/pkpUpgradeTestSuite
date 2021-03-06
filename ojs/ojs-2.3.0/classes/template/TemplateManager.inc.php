<?php

/**
 * @file classes/template/TemplateManager.inc.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class TemplateManager
 * @ingroup template
 *
 * @brief Class for accessing the underlying template engine.
 * Currently integrated with Smarty (from http://smarty.php.net/).
 *
 */

// $Id: TemplateManager.inc.php,v 1.142 2009/07/06 17:43:00 asmecher Exp $


import('search.ArticleSearch');
import('file.PublicFileManager');
import('template.PKPTemplateManager');

class TemplateManager extends PKPTemplateManager {
	/**
	 * Constructor.
	 * Initialize template engine and assign basic template variables.
	 */
	function TemplateManager() {
		parent::PKPTemplateManager();

		// Are we using implicit authentication?
		$this->assign('implicitAuth', Config::getVar('security', 'implicit_auth'));

		if (!defined('SESSION_DISABLE_INIT')) {
			/**
			 * Kludge to make sure no code that tries to connect to
			 * the database is executed (e.g., when loading
			 * installer pages).
			 */

			$journal =& Request::getJournal();
			$site =& Request::getSite();

			$siteFilesDir = Request::getBaseUrl() . '/' . PublicFileManager::getSiteFilesPath();
			$this->assign('sitePublicFilesDir', $siteFilesDir);
			$this->assign('publicFilesDir', $siteFilesDir); // May be overridden by journal

			$siteStyleFilename = PublicFileManager::getSiteFilesPath() . '/' . $site->getSiteStyleFilename();
			if (file_exists($siteStyleFilename)) $this->addStyleSheet(Request::getBaseUrl() . '/' . $siteStyleFilename);

			$this->assign('homeContext', array());

			if (isset($journal)) {
				
				$this->assign_by_ref('currentJournal', $journal);
				$journalTitle = $journal->getLocalizedTitle();
				$this->assign('siteTitle', $journalTitle);
				$this->assign('publicFilesDir', Request::getBaseUrl() . '/' . PublicFileManager::getJournalFilesPath($journal->getJournalId()));

				$this->assign('primaryLocale', $journal->getPrimaryLocale());
				$this->assign('alternateLocales', $journal->getSetting('alternateLocales'));

				// Assign additional navigation bar items
				$navMenuItems =& $journal->getLocalizedSetting('navItems');
				$this->assign_by_ref('navMenuItems', $navMenuItems);

				// Assign journal page header
				$this->assign('displayPageHeaderTitle', $journal->getLocalizedPageHeaderTitle());
				$this->assign('displayPageHeaderLogo', $journal->getLocalizedPageHeaderLogo());
				$this->assign('displayPageHeaderTitleAltText', $journal->getLocalizedSetting('pageHeaderTitleImageAltText'));
				$this->assign('displayPageHeaderLogoAltText', $journal->getLocalizedSetting('pageHeaderLogoImageAltText'));
				$this->assign('displayFavicon', $journal->getLocalizedFavicon());
				$this->assign('faviconDir', Request::getBaseUrl() . '/' . PublicFileManager::getJournalFilesPath($journal->getJournalId()));
				$this->assign('alternatePageHeader', $journal->getLocalizedSetting('journalPageHeader'));
				$this->assign('metaSearchDescription', $journal->getLocalizedSetting('searchDescription'));
				$this->assign('metaSearchKeywords', $journal->getLocalizedSetting('searchKeywords'));
				$this->assign('metaCustomHeaders', $journal->getLocalizedSetting('customHeaders'));
				$this->assign('numPageLinks', $journal->getSetting('numPageLinks'));
				$this->assign('itemsPerPage', $journal->getSetting('itemsPerPage'));
				$this->assign('enableAnnouncements', $journal->getSetting('enableAnnouncements'));

				// Load and apply theme plugin, if chosen
				$themePluginPath = $journal->getSetting('journalTheme');
				if (!empty($themePluginPath)) {
					// Load and activate the theme
					$themePlugin =& PluginRegistry::loadPlugin('themes', $themePluginPath);
					if ($themePlugin) $themePlugin->activate($this);
				}

				// Assign stylesheets and footer
				$journalStyleSheet = $journal->getSetting('journalStyleSheet');
				if ($journalStyleSheet) {
					$this->addStyleSheet(Request::getBaseUrl() . '/' . PublicFileManager::getJournalFilesPath($journal->getJournalId()) . '/' . $journalStyleSheet['uploadName']);
				}
				
				import('payment.ojs.OJSPaymentManager');
				$paymentManager =& OJSPaymentManager::getManager();
				$this->assign('journalPaymentsEnabled', $paymentManager->isConfigured());				

				$this->assign('pageFooter', $journal->getLocalizedSetting('journalPageFooter'));	
			} else {
				// Add the site-wide logo, if set for this locale or the primary locale
				$this->assign('displayPageHeaderTitle', $site->getLocalizedPageHeaderTitle());

				$this->assign('siteTitle', $site->getLocalizedTitle());
			}

			if (!$site->getRedirect()) {
				$this->assign('hasOtherJournals', true);
			}
		}
	}

	/**
	 * Smarty usage: {get_help_id key="(dir)*.page.topic" url="boolean"}
	 *
	 * Custom Smarty function for retrieving help topic ids.
	 * Direct mapping of page topic key to a numerical value representing the associated help topic xml file
	 * @params $params array associative array, must contain "key" parameter for string to translate
	 * @params $smarty Smarty
	 * @return numerical help topic id
	 */
	function smartyGetHelpId($params, &$smarty) {
		import('help.Help');
		$help =& Help::getHelp();
		if (isset($params) && !empty($params)) {
			if (isset($params['key'])) {
				$key = $params['key'];
				unset($params['key']);
				$translatedKey = $help->translate($key);
			} else {
				$translatedKey = $help->translate('');
			}

			if ($params['url'] == "true") {
				return Request::url(null, 'help', 'view', explode('/', $translatedKey));
			} else {
				return $translatedKey;
			}
		}
	}

	/**
	 * Smarty usage: {help_topic key="(dir)*.page.topic" text="foo"}
	 *
	 * Custom Smarty function for creating anchor tags
	 * @params $params array associative array
	 * @params $smarty Smarty
	 * @return anchor link to related help topic
	 */
	function smartyHelpTopic($params, &$smarty) {
		import('help.Help');
		$help =& Help::getHelp();
		if (isset($params) && !empty($params)) {
			$translatedKey = isset($params['key']) ? $help->translate($params['key']) : $help->translate('');
			$link = Request::url(null, 'help', 'view', explode('/', $translatedKey));
			$text = isset($params['text']) ? $params['text'] : '';
			return "<a href=\"$link\">$text</a>";
		}
	}

	/**
	 * Generate a URL into OJS. (This is a wrapper around Request::url to make it available to Smarty templates.)
	 */
	function smartyUrl($params, &$smarty) {
		// Extract the variables named in $paramList, and remove them
		// from the params array. Variables remaining in params will be
		// passed along to Request::url as extra parameters.
		$context = array();
		$contextList = OJSApplication::getContextList();

		if ( !isset($params['context']) ) {
			foreach ($contextList as $contextName) {
				if (isset($params[$contextName])) {
					$context[$contextName] = $params[$contextName];
					unset($params[$contextName]);
				} else {
					$context[$contextName] = null;				
				}
			}
			$params['context'] = $context;
		}
		
		return parent::smartyUrl($params, $smarty);
	}

	/**
	 * Display page links for a listing of items that has been
	 * divided onto multiple pages.
	 * Usage:
	 * {page_links
	 * 	name="nameMustMatchGetRangeInfoCall"
	 * 	iterator=$myIterator
	 *	additional_param=myAdditionalParameterValue
	 * }
	 */
	function smartyPageLinks($params, &$smarty) {
		$iterator = $params['iterator'];
		$name = $params['name'];
		if (isset($params['params']) && is_array($params['params'])) {
			$extraParams = $params['params'];
			unset($params['params']);
			$params = array_merge($params, $extraParams);
		}
		if (isset($params['anchor'])) {
			$anchor = $params['anchor'];
			unset($params['anchor']);
		} else {
			$anchor = null;
		}
		if (isset($params['all_extra'])) {
			$allExtra = ' ' . $params['all_extra'];
			unset($params['all_extra']);
		} else {
			$allExtra = '';
		}

		unset($params['iterator']);
		unset($params['name']);

		$numPageLinks = $smarty->get_template_vars('numPageLinks');
		if (!is_numeric($numPageLinks)) $numPageLinks=10;

		$page = $iterator->getPage();
		$pageCount = $iterator->getPageCount();
		$itemTotal = $iterator->getCount();

		$pageBase = max($page - floor($numPageLinks / 2), 1);
		$paramName = $name . 'Page';

		if ($pageCount<=1) return '';

		$value = '';

		if ($page>1) {
			$params[$paramName] = 1;
			$value .= '<a href="' . Request::url(null, null, null, Request::getRequestedArgs(), $params, $anchor, true) . '"' . $allExtra . '>&lt;&lt;</a>&nbsp;';
			$params[$paramName] = $page - 1;
			$value .= '<a href="' . Request::url(null, null, null, Request::getRequestedArgs(), $params, $anchor, true) . '"' . $allExtra . '>&lt;</a>&nbsp;';
		}

		for ($i=$pageBase; $i<min($pageBase+$numPageLinks, $pageCount+1); $i++) {
			if ($i == $page) {
				$value .= "<strong>$i</strong>&nbsp;";
			} else {
				$params[$paramName] = $i;
				$value .= '<a href="' . Request::url(null, null, null, Request::getRequestedArgs(), $params, $anchor, true) . '"' . $allExtra . '>' . $i . '</a>&nbsp;';
			}
		}
		if ($page < $pageCount) {
			$params[$paramName] = $page + 1;
			$value .= '<a href="' . Request::url(null, null, null, Request::getRequestedArgs(), $params, $anchor, true) . '"' . $allExtra . '>&gt;</a>&nbsp;';
			$params[$paramName] = $pageCount;
			$value .= '<a href="' . Request::url(null, null, null, Request::getRequestedArgs(), $params, $anchor, true) . '"' . $allExtra . '>&gt;&gt;</a>&nbsp;';
		}

		return $value;
	}
}

?>
