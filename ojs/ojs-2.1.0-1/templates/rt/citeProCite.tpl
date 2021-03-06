{**
 * citeReferenceManager.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Reference Manager citation format generator
 *
 * $Id: citeProCite.tpl,v 1.7 2005/12/06 06:04:56 alec Exp $
 *}

{if $galleyId}
	{url|assign:"articleUrl" page="article" op="view" path=$articleId|to_array:$galleyId}
{else}
	{url|assign:"articleUrl" page="article" op="view" path=$articleId}
{/if}
	TY  - JOUR
{foreach from=$article->getAuthors() item=author}
	AU  - {$author->getFullName(true)|escape}
{/foreach}
	PY  - {$article->getDatePublished()|date_format:"%Y"}
	TI  - {$article->getArticleTitle()|strip_tags}
	JF  - {$journal->getTitle()}; {$issue->getIssueIdentification()}
	Y2  - {$article->getDatePublished()|date_format:"%Y"}
	KW  - {$article->getSubject()|escape}
	N2  - {$article->getArticleAbstract()|escape}
	UR  - {$articleUrl}
	
