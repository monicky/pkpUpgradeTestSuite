{**
 * submission.tpl
 *
 * Copyright (c) 2003-2006 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Show the details of a submission.
 *
 *
 * $Id: submission.tpl,v 1.12 2006/06/12 23:26:32 alec Exp $
 *}

{translate|assign:"pageTitleTranslated" key="submission.page.editing" id=$submission->getArticleId()}
{assign var="pageCrumbTitle" value="submission.editing"}

{include file="common/header.tpl"}

{include file="proofreader/submission/summary.tpl"}

<div class="separator"></div>

{include file="proofreader/submission/layout.tpl"}

<div class="separator"></div>

{include file="proofreader/submission/proofread.tpl"}

<div class="separator"></div>

{include file="proofreader/submission/scheduling.tpl"}

{include file="common/footer.tpl"}
