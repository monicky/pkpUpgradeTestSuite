{**
 * links.tpl
 *
 * Copyright (c) 2003-2007 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Feed plugin navigation sidebar.
 *
 * $Id: block.tpl,v 1.3 2007/10/23 18:40:56 asmecher Exp $
 *}
<div class="block" id="sidebarWebFeed">
{if ( $displayPage eq "all" ) || ($displayPage eq "issue" && $issue) }
	<a href="{url page="gateway" op="plugin" path="WebFeedGatewayPlugin"|to_array:"atom"}">
	<img src="{$baseUrl}/plugins/generic/webFeed/templates/images/atom10_logo.gif" alt="" border="0" /></a>
	<br/>
	<a href="{url page="gateway" op="plugin" path="WebFeedGatewayPlugin"|to_array:"rss2"}">
	<img src="{$baseUrl}/plugins/generic/webFeed/templates/images/rss20_logo.gif" alt="" border="0" /></a>
	<br/>
	<a href="{url page="gateway" op="plugin" path="WebFeedGatewayPlugin"|to_array:"rss"}">
	<img src="{$baseUrl}/plugins/generic/webFeed/templates/images/rss10_logo.gif" alt="" border="0" /></a>
{/if}
</div>
