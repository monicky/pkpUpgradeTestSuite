{**
 * errors.tpl
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Google Scholar error list
 *
 * $Id: errors.tpl,v 1.4 2007/09/04 16:31:42 asmecher Exp $
 *}
{assign var="pageTitle" value="plugins.gateways.googleScholar.displayName"}
{include file="common/header.tpl"}

<br/>

<h3>{translate key="plugins.gateways.googleScholar.errors"}</h3>

<ul>
{foreach from=$errors item=error}
	<li>{$error|escape}</li>
{foreachelse}
	<li>{translate key="plugins.gateways.googleScholar.errors.noErrors"}</li>
{/foreach}
</ul>

<a class="action" href="{plugin_url path="settings"}">{translate key="common.back"}</a>

{include file="common/footer.tpl"}
