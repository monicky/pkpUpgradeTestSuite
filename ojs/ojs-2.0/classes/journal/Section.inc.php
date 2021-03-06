<?php

/**
 * Section.inc.php
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package journal
 *
 * Section class.
 * Describes basic section properties.
 *
 * $Id: Section.inc.php,v 1.6 2005/03/14 22:28:35 alec Exp $
 */

class Section extends DataObject {

	/**
	 * Constructor.
	 */
	function Section() {
		parent::DataObject();
	}
	
	//
	// Get/set methods
	//
	
	/**
	 * Get ID of section.
	 * @return int
	 */
	function getSectionId() {
		return $this->getData('sectionId');
	}
	
	/**
	 * Set ID of section.
	 * @param $sectionId int
	 */
	function setSectionId($sectionId) {
		return $this->setData('sectionId', $sectionId);
	}
	
	/**
	 * Get ID of journal.
	 * @return int
	 */
	function getJournalId() {
		return $this->getData('journalId');
	}
	
	/**
	 * Set ID of journal.
	 * @param $journalId int
	 */
	function setJournalId($journalId) {
		return $this->setData('journalId', $journalId);
	}
	
	/**
	 * Get title of section.
	 * @return string
	 */
	function getTitle() {
		return $this->getData('title');
	}
	
	/**
	 * Set title of section.
	 * @param $title string
	 */
	function setTitle($title) {
		return $this->setData('title', $title);
	}
	
	/**
	 * Get section title abbreviation.
	 * @return string
	 */
	function getAbbrev() {
		return $this->getData('abbrev');
	}
	
	/**
	 * Set section title abbreviation.
	 * @param $abbrev string
	 */
	function setAbbrev($abbrev) {
		return $this->setData('abbrev', $abbrev);
	}
	
	/**
	 * Get sequence of section.
	 * @return float
	 */
	function getSequence() {
		return $this->getData('sequence');
	}
	
	/**
	 * Set sequence of section.
	 * @param $sequence float
	 */
	function setSequence($sequence) {
		return $this->setData('sequence', $sequence);
	}
	
	/**
	 * Get open archive setting of section.
	 * @return float
	 */
	function getMetaIndexed() {
		return $this->getData('metaIndexed');
	}
	
	/**
	 * Set open archive setting of section.
	 * @param $metaIndexed boolean
	 */
	function setMetaIndexed($metaIndexed) {
		return $this->setData('metaIndexed', $metaIndexed);
	}
	
	/**
	 * Return boolean indicating whether or not submissions are restricted to [section]Editors.
	 * @return boolean
	 */
	function getEditorRestricted() {
		return $this->getData('editorRestricted');
	}
	
	/**
	 * Set whether or not submissions are restricted to [section]Editors.
	 * @param $metaIndexed boolean
	 */
	function setEditorRestricted($editorRestricted) {
		return $this->setData('editorRestricted', $editorRestricted);
	}
	
	/**
	 * Get policy.
	 * @return string
	 */
	function getPolicy() {
		return $this->getData('policy');
	}
	
	/**
	 * Set policy.
	 * @param $policy string
	 */
	function setPolicy($policy) {
		return $this->setData('policy', $policy);
	}
	
}

?>
