{**
 * submissionsInReview.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Show editor's submissions in review.
 *
 * $Id: submissionsInReview.tpl,v 1.26 2005/09/08 18:43:28 alec Exp $
 *}

<table width="100%" class="listing">
	<tr>
		<td colspan="8" class="headseparator">&nbsp;</td>
	</tr>
	<tr class="heading" valign="bottom">
		<td width="5%">{translate key="common.id"}</td>
		<td width="5%"><span class="disabled">MM-DD</span><br />{translate key="submissions.submit"}</td>
		<td width="5%">{translate key="submissions.sec"}</td>
		<td width="15%">{translate key="article.authors"}</td>
		<td width="30%">{translate key="article.title"}</td>
		<td width="30%">
			{translate key="submission.peerReview"}
			<table width="100%">
				<tr valign="top">
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">{translate key="submission.ask"}</td>
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">{translate key="submission.start"}</td>
					<td width="34%" style="padding: 0 0 0 0; font-size: 1.0em">{translate key="submission.done"}</td>
				</tr>
			</table>
		</td>
		<td width="5%">{translate key="submissions.ruling"}</td>
		<td width="5%">{translate key="article.sectionEditor"}</td>
	</tr>
	<tr>
		<td colspan="8" class="headseparator">&nbsp;</td>
	</tr>
	
	{iterate from=submissions item=submission}
	<tr valign="top">
		<td>{$submission->getArticleId()}</td>
		<td>{$submission->getDateSubmitted()|date_format:$dateFormatTrunc}</td>
		<td>{$submission->getSectionAbbrev()|escape}</td>
		<td>{$submission->getAuthorString(true)|truncate:40:"..."|escape}</td>
		<td><a href="{$requestPageUrl}/submissionReview/{$submission->getArticleId()}" class="action">{$submission->getArticleTitle()|truncate:40:"..."|escape}</a></td>
		<td>
			<table width="100%">
			{foreach from=$submission->getReviewAssignments() item=reviewAssignments}
				{foreach from=$reviewAssignments item=assignment name=assignmentList}
				<tr valign="top">
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">{if $assignment->getDateNotified()}{$assignment->getDateNotified()|date_format:$dateFormatTrunc}{else}&mdash;{/if}</td>
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">{if $assignment->getDateConfirmed()}{if !$assignment->getDeclined()}{$assignment->getDateConfirmed()|date_format:$dateFormatTrunc}{else}{translate key="common.notApplicableShort"}{/if}{else}&mdash;{/if}</td>
					<td width="34%" style="padding: 0 0 0 0; font-size: 1.0em">{if $assignment->getDateCompleted()}{$assignment->getDateCompleted()|date_format:$dateFormatTrunc}{else}&mdash;{/if}</td>
				</tr>
				{foreachelse}
				<tr valign="top">
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">&mdash;</td>
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">&mdash;</td>
					<td width="34%" style="padding: 0 0 0 0; font-size: 1.0em">&mdash;</td>
				</tr>
				{/foreach}
			{foreachelse}
				<tr valign="top">
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">&mdash;</td>
					<td width="33%" style="padding: 0 4px 0 0; font-size: 1.0em">&mdash;</td>
					<td width="34%" style="padding: 0 0 0 0; font-size: 1.0em">&mdash;</td>
				</tr>
			{/foreach}
			</table>
		</td>
		<td>
			{foreach from=$submission->getDecisions() item=decisions}
				{foreach from=$decisions item=decision name=decisionList}
					{if $smarty.foreach.decisionList.last}
							{$decision.dateDecided|date_format:$dateFormatTrunc}				
					{/if}
				{foreachelse}
					&mdash;
				{/foreach}
			{foreachelse}
				&mdash;
			{/foreach}
		</td>
		<td>{assign var="editAssignment" value=$submission->getEditor()}{$editAssignment->getEditorInitials()|escape}</td>
	</tr>
	<tr>
		<td colspan="8" class="{if $submissions->eof()}end{/if}separator">&nbsp;</td>
	</tr>
{/iterate}
{if $submissions->wasEmpty()}
	<tr>
		<td colspan="8" class="nodata">{translate key="submissions.noSubmissions"}</td>
	</tr>
	<tr>
		<td colspan="8" class="endseparator">&nbsp;</td>
	</tr>
{else}
	<tr>
		<td colspan="5" align="left">{page_info iterator=$submissions}</td>
		<td colspan="3" align="right">{page_links name="submissions" iterator=$submissions}</td>
	</tr>
{/if}
</table>
