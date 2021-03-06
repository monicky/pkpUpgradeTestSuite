{**
 * schedulingQueue.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Articles waiting to be scheduled for publishing.
 *
 * $Id: schedulingQueue.tpl,v 1.32 2006/06/12 23:26:27 alec Exp $
 *}

{assign var="pageTitle" value="editor.schedulingQueue"}
{url|assign:"currentUrl" op="schedulingQueue"}
{include file="common/header.tpl"}

<ul class="menu">
	<li><a href="{url op="createIssue"}">{translate key="editor.navigation.createIssue"}</a></li>
	<li class="current"><a href="{url op="schedulingQueue"}">{translate key="common.queue.short.submissionsInScheduling"}</a></li>
	<li><a href="{url op="futureIssues"}">{translate key="editor.navigation.futureIssues"}</a></li>
	<li><a href="{url op="backIssues"}">{translate key="editor.navigation.issueArchive"}</a></li>
</ul>

<br/>

<form action="#">{translate key="section.section"}:&nbsp;<select name="section" onchange="location.href='{url section="SECTION_ID" escape=false}'.replace('SECTION_ID', this.options[this.selectedIndex].value)" size="1" class="selectMenu">{html_options options=$sectionOptions selected=$section}</select></form>

<br />

<form method="post" action="{url op="updateSchedulingQueue"}" onsubmit="return confirm('{translate|escape:"javascript" key="editor.schedulingQueue.saveChanges"}')">

<table class="listing" width="100%">
	<tr>
		<td colspan="7" class="headseparator">&nbsp;</td>
	</tr>
	<tr valign="bottom" class="heading">
		<td width="5%">{translate key="common.id"}</td>
		<td width="5%"><span class="disabled">MM-DD</span><br />{translate key="submissions.submit"}</td>
		<td width="5%">{translate key="submissions.sec"}</td>
		<td width="20%">{translate key="article.authors"}</td>
		<td width="35%">{translate key="article.title"}</td>
		<td width="20%">{translate key="editor.schedulingQueue.schedule"}</td>
		<td width="10%">{translate key="common.remove"}</td>
	</tr>
	<tr>
		<td colspan="7" class="headseparator">&nbsp;</td>
	</tr>
	{iterate from=schedulingQueueSubmissions item=submission}
	<tr valign="top">
		<td>{$submission->getArticleId()}</td>
		<td>{$submission->getDateSubmitted()|date_format:$dateFormatTrunc}</td>
		<td>{$submission->getSectionAbbrev()|escape}</td>
		<td>{$submission->getAuthorString(true)|truncate:40:"..."|escape}</td>
		<td><a href="{url op="submission" path=$submission->getArticleId()}" class="action">{$submission->getArticleTitle()|strip_unsafe_html|truncate:40:"..."}</a></td>
		<td><select name="schedule[{$submission->getArticleID()}]" class="selectMenu">{html_options options=$issueOptions|truncate:40:"..."}</select></td>
		<td width="10%"><input type="checkbox" name="remove[]" value="{$submission->getArticleID()}" /></td>
	</tr>
	<tr>
		<td colspan="7" class="{if $schedulingQueueSubmissions->eof()}end{/if}separator">&nbsp;</td>
	</tr>
{/iterate}
{if $schedulingQueueSubmissions->wasEmpty()}
	<tr>
		<td colspan="7" class="nodata">{translate key="submissions.noSubmissions"}</td>
	</tr>
	<tr>
		<td colspan="7" class="endseparator">&nbsp;</td>
	</tr>
{else}
	<tr>
		<td colspan="4" align="left">{page_info iterator=$schedulingQueueSubmissions}</td>
		<td colspan="3" align="right">{page_links name="articles" iterator=$schedulingQueueSubmissions section=$section}</td>
	</tr>
{/if}
</table>

<input type="submit" value="{translate key="common.saveAndContinue"}" class="button defaultButton" />
</form>

{include file="common/footer.tpl"}
