{**
 * site.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * About the Journal site.
 *
 * $Id: site.tpl,v 1.9 2005/08/03 19:40:29 alec Exp $
 *}

{assign var="pageTitle" value="about.aboutSite"}
{include file="common/header.tpl"}
{if !empty($about)}
	<p>{$about|nl2br}</p>
{/if}

<h3>{translate key="journal.journals"}</h3>
<ul class="plain">
{iterate from=journals item=journal}
	<li>&#187; <a href="{$indexUrl}/{$journal->getPath()}/about">{$journal->getTitle()|escape}</a></li>
{/iterate}
</ul>

<a href="{$pageUrl}/about/aboutThisPublishingSystem">{translate key="about.aboutThisPublishingSystem"}</a>

{include file="common/footer.tpl"}
