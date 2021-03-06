{**
 * submitSuccess.tpl
 *
 * Copyright (c) 2000-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Display a message indicating that the article was successfuly submitted.
 *
 * $Id: submitSuccess.tpl,v 1.1 2009/06/16 21:09:19 mcrider Exp $
 *}
{strip}
{assign var="pageTitle" value="plugins.importexport.quickSubmit.success"}
{include file="common/header.tpl"}
{/strip}

<p>{translate key="plugins.importexport.quickSubmit.successDescription"}  <a href="{plugin_url}">{translate key="plugins.importexport.quickSubmit.successReturn"}</a></p>

{include file="common/footer.tpl"}
