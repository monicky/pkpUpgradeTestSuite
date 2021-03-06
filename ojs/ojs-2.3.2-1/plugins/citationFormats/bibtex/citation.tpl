{**
 * citation.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Article reading tools -- Capture Citation BibTeX format
 *
 * $Id$
 *}
<div class="separator"></div>
<div id="citation">
{literal}
<pre style="font-size: 1.5em;">@article{{/literal}{$journal->getLocalizedInitials()|escape}{$articleId|escape}{literal},
	author = {{/literal}{assign var=authors value=$article->getAuthors()}{foreach from=$authors item=author name=authors key=i}{assign var=firstName value=$author->getFirstName()}{assign var=authorCount value=$authors|@count}{$firstName|escape} {$author->getLastName()|escape}{if $i<$authorCount-1} and {/if}{/foreach}{literal}},
	title = {{/literal}{$article->getLocalizedTitle()|strip_unsafe_html}{literal}},
	journal = {{/literal}{$journal->getLocalizedTitle()|escape}{literal}},
{/literal}{if $issue}{literal}	volume = {{/literal}{$issue->getVolume()|escape}{literal}},
	number = {{/literal}{$issue->getNumber()|escape}{literal}},{/literal}{/if}{literal}
	year = {{/literal}{$article->getDatePublished()|date_format:'%Y'}{literal}},
	keywords = {{/literal}{$article->getLocalizedSubject()|escape}{literal}},
	abstract = {{/literal}{$article->getLocalizedAbstract()|strip_tags:false}{literal}},
{/literal}{assign var=onlineIssn value=$journal->getSetting('onlineIssn')|escape}
{assign var=issn value=$journal->getSetting('issn')|escape}{if $issn}{literal}	issn = {{/literal}{$issn|escape}{literal}},{/literal}
{elseif $onlineIssn}{literal}	issn = {{/literal}{$onlineIssn|escape}{literal}},{/literal}{/if}

{literal}	url = {{/literal}{$articleUrl}{literal}}
}
</pre>
{/literal}
</div>
