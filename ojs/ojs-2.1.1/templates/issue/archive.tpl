{**
 * archive.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Issue Archive.
 *
 * $Id: archive.tpl,v 1.15 2006/06/12 23:26:28 alec Exp $
 *}

{assign var="pageTitle" value="archive.archives"} 
{include file="common/header.tpl"}

{iterate from=issues item=issue}
	{if $issue->getYear() != $lastYear}
		{if !$notFirstYear}
			{assign var=notFirstYear value=1}
		{else}
			</div>
			<br />
			<div class="separator"></div>
		{/if}
		<div>
		<h3>{$issue->getYear()|escape}</h3>
		{assign var=lastYear value=$issue->getYear()}
	{/if}
	<h4><a href="{url op="view" path=$issue->getBestIssueId($currentJournal)}">{$issue->getIssueIdentification()|escape}</a></h4>
{/iterate}
{if $notFirstYear}</div>{/if}

{if !$issues->wasEmpty()}
	{page_info iterator=$issues}&nbsp;&nbsp;&nbsp;&nbsp;
	{page_links name="issues" iterator=$issues}
{else}
	{translate key="current.noCurrentIssueDesc"}
{/if}

{include file="common/footer.tpl"}
