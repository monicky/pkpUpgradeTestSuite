{**
 * active.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Show the details of active submissions.
 *
 * $Id: active.tpl,v 1.18 2005/08/03 19:40:29 alec Exp $
 *}

<table class="listing" width="100%">
	<tr><td colspan="6" class="headseparator">&nbsp;</td></tr>
	<tr class="heading" valign="bottom">
		<td width="5%">{translate key="common.id"}</td>
		<td width="5%"><span class="disabled">MM-DD</span><br />{translate key="submissions.submit"}</td>
		<td width="5%">{translate key="submissions.sec"}</td>
		<td width="25%">{translate key="article.authors"}</td>
		<td width="35%">{translate key="article.title"}</td>
		<td width="25%" align="right">{translate key="common.status"}</td>
	</tr>
	<tr><td colspan="6" class="headseparator">&nbsp;</td></tr>

{iterate from=submissions item=submission}
	{assign var="articleId" value=$submission->getArticleId()}
	{assign var="progress" value=$submission->getSubmissionProgress()}

	<tr valign="top">
		<td>{$articleId}</td>
		<td>{if $submission->getDateSubmitted()}{$submission->getDateSubmitted()|date_format:$dateFormatTrunc}{else}&mdash;{/if}</td>
		<td>{$submission->getSectionAbbrev()|escape}</td>
		<td>{$submission->getAuthorString(true)|truncate:40:"..."|escape}</td>
		{if $progress == 0}
			<td><a href="{$requestPageUrl}/submission/{$articleId}" class="action">{if $submission->getArticleTitle()}{$submission->getArticleTitle()|truncate:60:"..."|escape}{else}{translate key="common.untitled"}{/if}</a></td>
			<td align="right">
				{assign var="status" value=$submission->getSubmissionStatus()}
				{if $status==STATUS_ARCHIVED}{translate key="submissions.archived"}
				{elseif $status==STATUS_QUEUED_UNASSIGNED}{translate key="submissions.queuedUnassigned"}
				{elseif $status==STATUS_QUEUED_EDITING}<a href="{$requestPageUrl}/submissionEditing/{$articleId}" class="action">{translate key="submissions.queuedEditing"}</a>
				{elseif $status==STATUS_QUEUED_REVIEW}<a href="{$requestPageUrl}/submissionReview/{$articleId}" class="action">{translate key="submissions.queuedReview"}</a>
				{elseif $status==STATUS_SCHEDULED}{translate key="submissions.scheduled"}
				{elseif $status==STATUS_PUBLISHED}{translate key="submissions.published"}
				{elseif $status==STATUS_DECLINED}{translate key="submissions.declined"}
				{/if}
			</td>
		{else}
			<td><a href="{$pageUrl}/author/submit/{$progress}?articleId={$articleId}" class="action">{if $submission->getArticleTitle()}{$submission->getArticleTitle()|truncate:60:"..."|escape}{else}{translate key="common.untitled"}{/if}</a></td>
			<td align="right">{translate key="submissions.incomplete"}<br /><a href="{$pageUrl}/author/deleteSubmission/{$articleId}" class="action" onclick="return confirm('{translate|escape:"javascript" key="author.submissions.confirmDelete"}')">{translate key="common.delete"}</a></td>
		{/if}

	</tr>

	<tr>
		<td colspan="6" class="{if $submissions->eof()}end{/if}separator">&nbsp;</td>
	</tr>
{/iterate}
{if $submissions->wasEmpty()}
	<tr>
		<td colspan="6" class="nodata">{translate key="submissions.noSubmissions"}</td>
	</tr>
	<tr>
		<td colspan="6" class="endseparator">&nbsp;</td>
	</tr>
{else}
	<tr>
		<td colspan="4" align="left">{page_info iterator=$submissions}</td>
		<td colspan="2" align="right">{page_links name="submissions" iterator=$submissions}</td>
	</tr>
{/if}
</table>
