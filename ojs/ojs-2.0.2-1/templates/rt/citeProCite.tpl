{**
 * citeReferenceManager.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Reference Manager citation format generator
 *
 * $Id: citeProCite.tpl,v 1.4 2005/08/03 19:40:30 alec Exp $
 *}

	TY  - JOUR
{foreach from=$article->getAuthors() item=author}
	AU  - {$author->getFullName(true)|escape}
{/foreach}
	PY  - {$article->getDatePublished()|date_format:"%Y"}
	TI  - {$article->getArticleTitle()|escape}
	JF  - {$journal->getTitle()}; {$issue->getIssueIdentification()}
	Y2  - {$article->getDatePublished()|date_format:"%Y"}
	KW  - {$article->getSubject()|escape}
	N2  - {$article->getArticleAbstract()|escape}
	UR  - {$pageUrl}/article/view/{$articleId|escape}/{$galleyId}
	
