<?php

/**
 * @file classes/scheduledTask/ScheduledTask.inc.php
 *
 * Copyright (c) 2000-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ScheduledTask
 * @ingroup core
 * @see ScheduledTaskDAO
 *
 * @brief Base class for executing scheduled tasks.
 * All scheduled task classes must extend this class and implement execute().
 */

// $Id: ScheduledTask.inc.php,v 1.3 2009/04/08 21:34:54 asmecher Exp $


class ScheduledTask {

	/** @var array task arguments */
	var $args;

	function ScheduledTask($args = array()) {
		$this->args = $args;
	}

	/**
	 * Fallback method in case task does not implement execute method.
	 */
	function execute() {
		fatalError("ScheduledTask does not implement execute()!\n");
	}
}

?>
