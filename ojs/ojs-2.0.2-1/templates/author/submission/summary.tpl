{**
 * summary.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Subtemplate defining the author's submission summary table.
 *
 * $Id: summary.tpl,v 1.12 2005/09/14 03:23:15 alec Exp $
 *}

<a name="submission"></a>
<h3>{translate key="article.submission"}</h3>

{assign var="editor" value=$submission->getEditor()}

<table width="100%" class="data">
	<tr>
		<td width="20%" class="label">{translate key="article.authors"}</td>
		<td width="80%">
			{assign var=urlEscaped value=$currentUrl|escape:"url"}
			{$submission->getAuthorString()|escape} {icon name="mail" url="`$pageUrl`/user/email?redirectUrl=$urlEscaped&amp;authorsArticleId=`$submission->getArticleId()`"}
		</td>
	</tr>
	<tr>
		<td class="label">{translate key="article.title"}</td>
		<td>{$submission->getArticleTitle()|escape}</td>
	</tr>
	<tr>
		<td class="label">{translate key="section.section"}</td>
		<td>{$submission->getSectionTitle()|escape}</td>
	</tr>
	<tr>
		<td class="label">{translate key="user.role.sectionEditor"}</td>
		<td>
			{if $editor}
				{assign var=emailString value="`$editor->getEditorFullName()` <`$editor->getEditorEmail()`>"}
				{assign var=emailStringEscaped value=$emailString|escape:"url"}
				{assign var=urlEscaped value=$currentUrl|escape:"url"}
				{assign var=subjectEscaped value=$submission->getArticleTitle()|escape:"url"}
				{$editor->getEditorFullName()|escape} {icon name="mail" url="`$pageUrl`/user/email?to[]=$emailStringEscaped&amp;redirectUrl=$urlEscaped&amp;subject=$subjectEscaped"}
			{else}
				{translate key="common.noneAssigned"}
			{/if}
		</td>
	</tr>
</table>
