{**
 * scheduling.tpl
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Subtemplate defining the scheduling view.
 *
 * $Id: scheduling.tpl,v 1.4 2007/09/04 16:31:45 asmecher Exp $
 *}
<a name="scheduling"></a>
<h3>{translate key="submission.scheduling"}</h3>

{if $issue}
	{assign var=issueName value=$issue->getIssueIdentification()}
{else}
	{translate|assign:"issueName" key="submission.scheduledIn.tba"}
{/if}

{translate key="submission.scheduledIn" issueName=$issueName}

{if $issue}
	{if $issue->getPublished()}
		<a href="{url page="issue" op="view" path=$issue->getBestIssueId()}" class="action">{translate key="issue.toc"}</a>
	{else}
		<a href="{url op="issueToc" path=$issue->getIssueId()}" class="action">{translate key="issue.toc"}</a>
	{/if}
{/if}