<?php

/**
 * @defgroup pages_user
 */
 
/**
 * @file pages/user/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup pages_user
 * @brief Handle requests for user functions. 
 *
 */

// $Id: index.php,v 1.10 2009/04/20 15:44:02 jalperin Exp $


switch ($op) {
	//
	// Profiles
	//
	case 'profile':
	case 'saveProfile':
	case 'changePassword':
	case 'savePassword':
		define('HANDLER_CLASS', 'ProfileHandler');
		import('pages.user.ProfileHandler');
		break;
	//
	// Registration
	//
	case 'register':
	case 'registerUser':
	case 'activateUser':
		define('HANDLER_CLASS', 'RegistrationHandler');
		import('pages.user.RegistrationHandler');
		break;
	//
	// Email
	//
	case 'email':
		define('HANDLER_CLASS', 'EmailHandler');
		import('pages.user.EmailHandler');
		break;
	default:	
		define('HANDLER_CLASS', 'UserHandler');
		import('pages.user.UserHandler');
}

?>
