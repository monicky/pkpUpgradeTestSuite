{**
 * readerReferrals.tpl
 *
 * Copyright (c) 2003-2009 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Referral listing for readers
 *
 * $Id: readerReferrals.tpl,v 1.3 2009/07/08 03:52:16 asmecher Exp $
 *}

<div class="separator"></div>

<h3>{translate key="plugins.generic.referral.referrals"}</h3>

<ul class="plain">
	{iterate from=referrals item=referral}
		<li>&#187; <a href="{$referral->getUrl()|escape}" target="_parent">{$referral->getReferralName()|escape}</a></li>
	{/iterate}
	{if $referrals->wasEmpty()}
		<li>{translate key="plugins.generic.referral.all.empty"}</li>
	{/if}
</ul>
