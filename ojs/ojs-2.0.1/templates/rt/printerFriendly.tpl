{**
 * printerFriendly.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Article View -- printer friendly version.
 *
 * $Id: printerFriendly.tpl,v 1.3 2005/06/28 05:43:59 kevin Exp $
 *}

<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>{$article->getFirstAuthor(true)}</title>
	<meta http-equiv="Content-Type" content="text/html; charset={$defaultCharset}" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" href="{$baseUrl}/styles/common.css" type="text/css" />
	<link rel="stylesheet" href="{$baseUrl}/styles/articleView.css" type="text/css" />
	{foreach from=$stylesheets item=cssFile}
	<link rel="stylesheet" href="{$baseUrl}/styles/{$cssFile}" type="text/css" />
	{/foreach}
	{if $pageStyleSheet}
	<link rel="stylesheet" href="{$publicFilesDir}/{$pageStyleSheet.uploadName}" type="text/css" />
	{/if}
	<script type="text/javascript" src="{$baseUrl}/js/general.js"></script>
</head>
<body>

<div id="container">

<div id="body">

<div id="main">

<h2>{$siteTitle},&nbsp;{$issue->getIssueIdentification(false,true)}</h2>

<div id="content">
{if $galley}
	{$galley->getHTMLContents("$requestPageUrl/viewFile")}
{else}

	<h3>{$article->getArticleTitle()}</h3>
	<div><i>{$article->getAuthorString()}</i></div>
	<br />
	<h4>{translate key="issue.abstract"}</h4>
	<br />
	<div>{$article->getArticleAbstract()}</div>

{/if}
</div>

</div>
</div>
</div>

<script type="text/javascript">
	window.print();
</script>

</body>
</html>
