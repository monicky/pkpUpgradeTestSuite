<?php

/**
 * @defgroup plugins_blocks_user
 */
 
/**
 * @file plugins/blocks/user/index.php
 *
 * Copyright (c) 2003-2008 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_blocks_user
 * @brief Wrapper for user block plugin.
 *
 */

// $Id: index.php,v 1.5 2008/07/01 01:16:13 asmecher Exp $


require_once('UserBlockPlugin.inc.php');

return new UserBlockPlugin();

?> 
