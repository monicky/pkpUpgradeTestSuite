{**
 * index.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Counter plugin index
 *
 * $Id: index.tpl,v 1.5.2.2 2009/04/08 19:43:15 asmecher Exp $
 *}
{assign var="pageTitle" value="plugins.generic.counter"}
{include file="common/header.tpl"}

<p>{translate key="plugins.generic.counter.description"}</p>

<ul class="plain">
	<li>&#187; {translate key="plugins.generic.counter.1a.title"}{foreach from=$years item=year}&nbsp;&nbsp;<a href="{url op="report" year=$year}">{$year|escape}</a>{/foreach}</li>
	{call_hook name="Template::Plugin::Generic::Counter::Index"}
</ul>

{include file="common/footer.tpl"}
