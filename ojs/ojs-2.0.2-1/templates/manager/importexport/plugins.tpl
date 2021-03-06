{**
 * plugins.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * List available import/export plugins.
 *
 * $Id: plugins.tpl,v 1.2 2005/08/03 19:40:30 alec Exp $
 *}

{assign var="pageTitle" value="manager.importExport"}
{include file="common/header.tpl"}

<ul>
	{foreach from=$plugins item=plugin}
	<li><a href="{$pageUrl}/manager/importexport/plugin/{$plugin->getName()|escape:"url"}">{$plugin->getDisplayName()|escape}</a>:&nbsp;{$plugin->getDescription()|escape}</li>
	{/foreach}
</ul>

{include file="common/footer.tpl"}
