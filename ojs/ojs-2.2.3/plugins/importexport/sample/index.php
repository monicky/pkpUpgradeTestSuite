<?php

/**
 * @defgroup plugins_importexport_sample
 */
 
/**
 * @file plugins/importexport/sample/index.php
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup plugins_importexport_sample
 * @brief Wrapper for sample import/export plugin.
 *
 */

// $Id: index.php,v 1.8.2.1 2009/04/08 19:43:25 asmecher Exp $


require_once('SampleImportExportPlugin.inc.php');

return new SampleImportExportPlugin();

?>
