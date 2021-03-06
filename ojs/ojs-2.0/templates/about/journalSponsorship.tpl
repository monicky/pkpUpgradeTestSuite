{**
 * journalSponsorship.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * About the Journal / Journal Sponsorship.
 *
 * $Id: journalSponsorship.tpl,v 1.5 2005/05/01 05:29:54 kevin Exp $
 *}

{assign var="pageTitle" value="about.journalSponsorship"}
{include file="common/header.tpl"}

<h3>{translate key="common.publisher"}</h3>

{if $publisher.note}<p>{$publisher.note|nl2br}</p>{/if}

<p><a href="{$publisher.url}">{$publisher.institution}</a></p>

<div class="separator"></div>

<h3>{translate key="about.sponsors"}</h3>

{if $sponsorNote}<p>{$sponsorNote|nl2br}</p>{/if}

<ul>
	{foreach from=$sponsors item=sponsor}
	{if $sponsor.institution}
		{if $sponsor.url}
			<li><a href="{$sponsor.url}">{$sponsor.institution}</a></li>
		{else}
			<li>{$sponsor.institution}</li>
		{/if}
	{/if}
	{/foreach}
</ul>

<div class="separator"></div>

<h3>{translate key="about.contributors"}</h3>

{if $contributorNote}<p>{$contributorNote|nl2br}</p>{/if}

<ul>
	{foreach from=$contributors item=contributor}
	{if $contributor.name}
		{if $contributor.url}
			<li><a href="{$contributor.url}">{$contributor.name}</a></li>
		{else}
			<li>{$contributor.name}</li>
		{/if}
	{/if}
	{/foreach}
</ul>

{include file="common/footer.tpl"}
