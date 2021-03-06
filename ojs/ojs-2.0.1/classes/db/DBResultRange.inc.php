<?php

/**
 * DBResultRange.inc.php
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @package db
 *
 * Container class for range information when retrieving a result set.
 *
 * $Id: DBResultRange.inc.php,v 1.3 2005/05/05 13:42:03 alec Exp $
 */

class DBResultRange {
	/** The number of items to display */
	var $count;

	/** The number of pages to skip */
	var $page;

	/**
	 * Constructor.
	 * Initialize the DBResultRange.
	 */
	function DBResultRange($count, $page = 1) {
		$this->count = $count;
		$this->page = $page;
	}

	/**
	 * Checks to see if the DBResultRange is valid.
	 * @return boolean
	 */
	function isValid() {
		return (($this->count>0) && ($this->page>=0));
	}

	/**
	 * Returns the count of pages to skip.
	 * @return int
	 */
	function getPage() {
		return $this->page;
	}

	/**
	 * Returns the count of items in this range to display.
	 * @return int
	 */
	function getCount() {
		return $this->count;
	}
}

?>
