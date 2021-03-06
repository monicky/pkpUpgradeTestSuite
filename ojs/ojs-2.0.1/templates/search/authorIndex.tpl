{**
 * authorIndex.tpl
 *
 * Copyright (c) 2003-2004 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Index of published articles by author.
 *
 * $Id: authorIndex.tpl,v 1.6 2005/06/28 00:35:59 alec Exp $
 *}

{assign var="start" value="A"|ord}

{assign var="pageTitle" value="search.authorIndex"}
{include file="common/header.tpl"}

<p>{section loop=26 name=letters}<a href="{$requestPageUrl}/authors?searchInitial={$smarty.section.letters.index+$start|chr}">{if chr($smarty.section.letters.index+$start) == $searchInitial}<strong>{$smarty.section.letters.index+$start|chr}</strong>{else}{$smarty.section.letters.index+$start|chr}{/if}</a> {/section}<a href="{$requestPageUrl}/authors">{if $searchInitial==''}<strong>{translate key="common.all"}</strong>{else}{translate key="common.all"}{/if}</a></p>

{iterate from=authors item=author}
	{assign var=lastFirstLetter value=$firstLetter}
	{assign var=firstLetter value=$author->getLastName()}
	{assign var=firstLetter value=$firstLetter[0]}

	{if $lastFirstLetter != $firstLetter}
		<br />
		<a name="{$firstLetter}"></a>
		<h3>{$firstLetter}</h3>
	{/if}

	<a href="{$requestPageUrl}/authors/view?firstName={$author->getFirstName()|escape:'url'}&middleName={$author->getMiddleName()|escape:'url'}&lastName={$author->getLastName()|escape:'url'}&affiliation={$author->getAffiliation()|escape:'url'}">
		{$author->getLastName(true)},
		{$author->getFirstName()}{if $author->getMiddleName()} {$author->getMiddleName}{/if}{if $author->getAffiliation()}, {$author->getAffiliation()}{/if}
	</a>
	<br/>
{/iterate}
{if !$authors->wasEmpty()}
	<br />
	{page_info iterator=$authors}&nbsp;&nbsp;&nbsp;&nbsp;{page_links iterator=$authors name="authors"}
{else}
{/if}

{include file="common/footer.tpl"}
