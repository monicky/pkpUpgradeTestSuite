{**
 * index.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Site administration index.
 *
 * $Id: index.tpl,v 1.13 2005/02/17 02:11:31 kevin Exp $
 *}

{assign var="pageTitle" value="admin.siteAdmin"}
{include file="common/header.tpl"}

<h3>{translate key="admin.siteManagement"}</h3>

<ul class="plain">
	<li>&#187; <a href="{$pageUrl}/admin/settings">{translate key="admin.siteSettings"}</a></li>
	<li>&#187; <a href="{$pageUrl}/admin/journals">{translate key="admin.hostedJournals"}</a></li>
	<li>&#187; <a href="{$pageUrl}/admin/languages">{translate key="common.languages"}</a></li>
</ul>


<h3>{translate key="admin.adminFunctions"}</h3>

<ul class="plain">
	<li>&#187; <a href="{$pageUrl}/admin/systemInfo">{translate key="admin.systemInformation"}</a></li>
	<li>&#187; <a href="{$pageUrl}/admin/expireSessions" onclick="return confirm('{translate|escape:"javascript" key="admin.confirmExpireSessions"}')">{translate key="admin.expireSessions"}</a></li>
	<li>&#187; <a href="{$pageUrl}/admin/clearTemplateCache" onclick="return confirm('{translate|escape:"javascript" key="admin.confirmClearTemplateCache"}')">{translate key="admin.clearTemplateCache"}</a></li>
</ul>

{include file="common/footer.tpl"}
