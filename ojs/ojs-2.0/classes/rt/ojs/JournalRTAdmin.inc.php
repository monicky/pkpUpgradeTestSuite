<?php

/**
 * JournalRTAdmin.inc.php
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package rt.ojs
 *
 * OJS-specific Reading Tools administration interface.
 *
 * $Id: JournalRTAdmin.inc.php,v 1.4 2005/05/10 19:23:19 alec Exp $
 */

import('rt.RTAdmin');
import('rt.ojs.RTDAO');

define('RT_DIRECTORY', 'rt');

class JournalRTAdmin extends RTAdmin {

	/** @var $journalId int */
	var $journalId;
	
	/** @var $dao DAO */
	var $dao;
	

	function JournalRTAdmin($journalId) {
		$this->journalId = $journalId;
		$this->dao = &DAORegistry::getDAO('RTDAO');
	}

	function restoreVersions($deleteBeforeLoad = true) {
		import('rt.RTXMLParser');
		$parser = &new RTXMLParser();

		if ($deleteBeforeLoad) $this->dao->deleteVersionsByJournalId($this->journalId);

		$versions = $parser->parseAll(RT_DIRECTORY . '/' . Locale::getLocale()); // FIXME?
		foreach ($versions as $version) {
			$this->dao->insertVersion($this->journalId, $version);
		}
	}

	function importVersion($filename) {
		import ('rt.RTXMLParser');
		$parser = &new RTXMLParser();

		$version = &$parser->parse($filename);
		$this->dao->insertVersion($this->journalId, &$version);
	}
}

?>
