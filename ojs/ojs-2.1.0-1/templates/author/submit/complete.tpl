{**
 * complete.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * The submission process has been completed; notify the author.
 *
 * $Id: complete.tpl,v 1.4 2005/12/09 01:55:26 alec Exp $
 *}

{include file="common/header.tpl"}

<p>{translate key="author.submit.submissionComplete" journalTitle=$journal->getTitle()}</p>

{if $canExpedite}
	{url|assign:"expediteUrl" op="expediteSubmission" articleId=$articleId}
	{translate key="author.submit.expedite" expediteUrl=$expediteUrl}
{/if}

<p>&#187; <a href="{url op="track"}">{translate key="author.track"}</a></p>

{include file="common/footer.tpl"}
