{**
 * scheduling.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Subtemplate defining the scheduling table.
 *
 * $Id: scheduling.tpl,v 1.1 2006/05/30 19:30:29 alec Exp $
 *}

<a name="scheduling"></a>
<h3>{translate key="submission.scheduling"}</h3>

<form action="{url op="scheduleForPublication" path=$submission->getArticleId()}" method="post">
<p>
	<label for="issueId">{translate key="editor.article.scheduleForPublication"}</label>
	{if $publishedArticle}
		{assign var=issueId value=$publishedArticle->getIssueId()}
	{else}
		{assign var=issueId value=0}
	{/if}
	<select name="issueId" id="issueId" class="selectMenu">
		<option value="">{translate key="editor.article.scheduleForPublication.toBeAssigned"}</option>
		{html_options options=$issueOptions|truncate:40:"..." selected=$issueId}
	</select>&nbsp;
	<input type="submit" value="{translate key="common.record"}" class="button defaultButton" />&nbsp;
	{if $issueId}
		<a href="{url page="issue" op="view" path=$issueId}" class="action">{translate key="issue.toc"}</a>
	{/if}
</p>
</form>
