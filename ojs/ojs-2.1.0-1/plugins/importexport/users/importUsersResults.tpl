{**
 * importUsersResults.tpl
 *
 * Copyright (c) 2003-2005 The Public Knowledge Project
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Show the results of importing users.
 *
 * $Id: importUsersResults.tpl,v 1.5 2005/11/26 19:45:35 alec Exp $
 *}

{assign var="pageTitle" value="plugins.importexport.users.import.importUsers"}
{include file="common/header.tpl"}

{translate key="plugins.importexport.users.import.usersWereImported"}:
<table width="100%" class="listing">
	<tr>
		<td colspan="4" class="headseparator">&nbsp;</td>
	</tr>
	<tr class="heading" valign="bottom">
		<td width="15%">{translate key="user.username"}</td>
		<td width="25%">{translate key="user.name"}</td>
		<td width="30%">{translate key="user.email"}</td>
		<td width="30%" align="right">{translate key="common.action"}</td>
	</tr>
	<tr>
		<td colspan="4" class="headseparator">&nbsp;</td>
	</tr>
	{foreach name=importedUsers from=$importedUsers item=user}
	<tr valign="top">
		<td><a href="{url page="manager" path="userProfile"|to_array:$user->getUserId()}">{$user->getUsername()|escape}</a></td>
		<td>{$user->getFullName()|escape}</td>
		<td>{$user->getEmail()|escape}</td>
		<td align="right" class="nowrap">
			<a href="{url page="manager" path="editUser"|to_array:$user->getUserId()}" class="action">{translate key="common.edit"}</a>&nbsp;|&nbsp;<a href="{url page="manager" path="signInAsUser"|to_array:$user->getUserId()}" class="action">{translate key="manager.people.signInAs"}</a>
		</td>
	</tr>
	<tr>
		<td colspan="4" class="{if $smarty.foreach.importedUsers.last}end{/if}separator">&nbsp;</td>
	</tr>
	{foreachelse}
	<tr>
		<td colspan="4" class="nodata">{translate key="manager.people.noneEnrolled"}</td>
	</tr>
	<tr>
		<td colspan="4" class="endseparator">&nbsp;</td>
	</tr>
{/foreach}
</table>

{if $isError}
<p>
	<span class="formError">{translate key="plugins.importexport.users.import.errorsOccurred"}:</span>
	<ul class="formErrorList">
	{foreach key=field item=message from=$errors}
		<li>{$message}</li>
	{/foreach}
	</ul>
</p>
{/if}

<p>&#187; <a href="{url page="manager"}">{translate key="manager.journalManagement"}</a></p>

{include file="common/footer.tpl"}
