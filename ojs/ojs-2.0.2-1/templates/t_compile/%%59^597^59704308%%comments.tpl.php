<?php /* Smarty version 2.6.10, created on 2005-09-21 12:20:13
         compiled from comment/comments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'comment/comments.tpl', 14, false),array('modifier', 'truncate', 'comment/comments.tpl', 14, false),array('modifier', 'date_format', 'comment/comments.tpl', 24, false),array('modifier', 'strip_unsafe_html', 'comment/comments.tpl', 49, false),array('modifier', 'nl2br', 'comment/comments.tpl', 49, false),array('function', 'translate', 'comment/comments.tpl', 24, false),array('function', 'assign_translate', 'comment/comments.tpl', 34, false),array('function', 'mailto', 'comment/comments.tpl', 35, false),)), $this); ?>

<?php if ($this->_tpl_vars['comment']): ?>
	<?php $this->assign('pageTitle', "comments.readerComments"); ?>
	<?php $this->assign('pageCrumbTitleTranslated', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['comment']->getTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...") : smarty_modifier_truncate($_tmp, 50, "...")));  else: ?>
	<?php $this->assign('pageTitle', "comments.readerComments");  endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['comment']): ?>
	<?php $this->assign('user', $this->_tpl_vars['comment']->getUser()); ?>
	<h3><?php echo ((is_array($_tmp=$this->_tpl_vars['comment']->getTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h3>
	<h4><?php if ($this->_tpl_vars['user']):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.authenticated",'userName' => ((is_array($_tmp=$this->_tpl_vars['comment']->getPosterName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this); elseif ($this->_tpl_vars['comment']->getPosterName()):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.anonymousNamed",'userName' => ((is_array($_tmp=$this->_tpl_vars['comment']->getPosterName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this); else:  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.anonymous"), $this); endif; ?> (<?php echo ((is_array($_tmp=$this->_tpl_vars['comment']->getDatePosted())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>
)</h4>

	<p>

	<?php if ($this->_tpl_vars['parent']): ?>
		<?php $this->assign('parentId', $this->_tpl_vars['parent']->getCommentId()); ?>
		<i><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.inResponseTo",'url' => ($this->_tpl_vars['pageUrl'])."/comment/view/".($this->_tpl_vars['articleId'])."/".($this->_tpl_vars['parentId']),'title' => ((is_array($_tmp=$this->_tpl_vars['parent']->getTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this);?>
</i><br />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['comment']->getPosterEmail()): ?>
		<?php echo $this->_plugins['function']['assign_translate'][0][0]->smartyAssignTranslate(array('var' => 'emailReply','key' => "comments.emailReply"), $this);?>

		<?php echo smarty_function_mailto(array('text' => $this->_tpl_vars['emailReply'],'encode' => 'javascript','address' => $this->_tpl_vars['comment']->getPosterEmail(),'subject' => $this->_tpl_vars['comment']->getTitle(),'extra' => 'class="action"'), $this);?>
&nbsp;&nbsp;
	<?php endif; ?>

	<?php if ($this->_tpl_vars['enableComments'] == COMMENTS_UNAUTHENTICATED || ( ( $this->_tpl_vars['enableComments'] == COMMENTS_AUTHENTICATED || $this->_tpl_vars['enableComments'] == COMMENTS_ANONYMOUS ) && $this->_tpl_vars['isUserLoggedIn'] )): ?>
		<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/comment/add/<?php echo $this->_tpl_vars['articleId']; ?>
/<?php echo $this->_tpl_vars['galleyId']; ?>
/<?php echo $this->_tpl_vars['comment']->getCommentId(); ?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.postReply"), $this);?>
</a>&nbsp;&nbsp;
	<?php endif; ?>

	<?php if ($this->_tpl_vars['isManager']): ?>
		<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/comment/delete/<?php echo $this->_tpl_vars['articleId']; ?>
/<?php echo $this->_tpl_vars['galleyId']; ?>
/<?php echo $this->_tpl_vars['comment']->getCommentId(); ?>
" <?php if ($this->_tpl_vars['comment']->getChildCommentCount() != 0): ?>onclick="return confirm('<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.confirmDeleteChildren"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript'));?>
')" <?php endif; ?>class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.delete"), $this);?>
</a>
	<?php endif; ?>

	<br />
	</p>

	<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['comment']->getBody())) ? $this->_run_mod_handler('strip_unsafe_html', true, $_tmp) : $this->_plugins['modifier']['strip_unsafe_html'][0][0]->smartyStripUnsafeHtml($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>


<br /><br />

<div class="separator"></div>

<br />

<?php if ($this->_tpl_vars['comments']): ?><h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.replies"), $this);?>
</h3><?php endif; ?>

<?php endif; ?>

<?php $_from = $this->_tpl_vars['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['child']):
?>

<?php $this->assign('user', $this->_tpl_vars['child']->getUser());  $this->assign('childId', $this->_tpl_vars['child']->getCommentId()); ?>
<h4><a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/comment/view/<?php echo $this->_tpl_vars['articleId']; ?>
/<?php echo $this->_tpl_vars['galleyId']; ?>
/<?php echo $this->_tpl_vars['childId']; ?>
" target="_parent"><?php echo ((is_array($_tmp=$this->_tpl_vars['child']->getTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></h4>
<h5><?php if ($this->_tpl_vars['user']):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.authenticated",'userName' => ((is_array($_tmp=$this->_tpl_vars['child']->getPosterName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this); elseif ($this->_tpl_vars['child']->getPosterName()):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.anonymousNamed",'userName' => ((is_array($_tmp=$this->_tpl_vars['child']->getPosterName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this); else:  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.anonymous"), $this); endif; ?> (<?php echo ((is_array($_tmp=$this->_tpl_vars['child']->getDatePosted())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>
)</h5>
<?php if ($this->_tpl_vars['child']->getPosterEmail()): ?>
	<?php echo $this->_plugins['function']['assign_translate'][0][0]->smartyAssignTranslate(array('var' => 'emailReply','key' => "comments.emailReply"), $this);?>

	<?php echo smarty_function_mailto(array('text' => $this->_tpl_vars['emailReply'],'encode' => 'javascript','address' => ((is_array($_tmp=$this->_tpl_vars['child']->getPosterEmail())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)),'subject' => ((is_array($_tmp=$this->_tpl_vars['child']->getTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)),'extra' => 'class="action"'), $this);?>
&nbsp;&nbsp;
<?php endif; ?>

<?php if ($this->_tpl_vars['enableComments'] == COMMENTS_UNAUTHENTICATED || ( ( $this->_tpl_vars['enableComments'] == COMMENTS_AUTHENTICATED || $this->_tpl_vars['enableComments'] == COMMENTS_ANONYMOUS ) && $this->_tpl_vars['isUserLoggedIn'] )): ?>
	<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/comment/add/<?php echo $this->_tpl_vars['articleId']; ?>
/<?php echo $this->_tpl_vars['galleyId']; ?>
/<?php echo $this->_tpl_vars['childId']; ?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.postReply"), $this);?>
</a>&nbsp;&nbsp;
<?php endif;  if ($this->_tpl_vars['isManager']): ?>
	<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/comment/delete/<?php echo $this->_tpl_vars['articleId']; ?>
/<?php echo $this->_tpl_vars['galleyId']; ?>
/<?php echo $this->_tpl_vars['child']->getCommentId(); ?>
" <?php if ($this->_tpl_vars['child']->getChildCommentCount() != 0): ?>onclick="return confirm('<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.confirmDeleteChildren"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript'));?>
')" <?php endif; ?>class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.delete"), $this);?>
</a>
<?php endif; ?>
<br />

<?php echo $this->_plugins['function']['assign_translate'][0][0]->smartyAssignTranslate(array('var' => 'readMore','key' => "comments.readMore"), $this);?>

<?php $this->assign('moreLink', "<a href=\"".($this->_tpl_vars['pageUrl'])."/comment/view/".($this->_tpl_vars['articleId'])."/".($this->_tpl_vars['galleyId'])."/".($this->_tpl_vars['childId'])."\">".($this->_tpl_vars['readMore'])."</a>"); ?>
<p><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['child']->getBody())) ? $this->_run_mod_handler('strip_unsafe_html', true, $_tmp) : $this->_plugins['modifier']['strip_unsafe_html'][0][0]->smartyStripUnsafeHtml($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 300, "... ".($this->_tpl_vars['moreLink'])) : smarty_modifier_truncate($_tmp, 300, "... ".($this->_tpl_vars['moreLink']))); ?>
</p>

<?php $this->assign('grandChildren', $this->_tpl_vars['child']->getChildren());  if ($this->_tpl_vars['grandChildren']): ?><ul><?php endif;  $_from = $this->_tpl_vars['child']->getChildren(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['grandChild']):
 $this->assign('user', $this->_tpl_vars['grandChild']->getUser()); ?>
	<li>
		<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/comment/view/<?php echo $this->_tpl_vars['articleId']; ?>
/<?php echo $this->_tpl_vars['galleyId']; ?>
/<?php echo $this->_tpl_vars['grandChild']->getCommentId(); ?>
" target="_parent"><?php echo ((is_array($_tmp=$this->_tpl_vars['grandChild']->getTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a>
		<?php if ($this->_tpl_vars['grandChild']->getChildCommentCount() == 1):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.oneReply"), $this); elseif ($this->_tpl_vars['grandChild']->getChildCommentCount() > 0):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.nReplies",'num' => $this->_tpl_vars['grandChild']->getChildCommentCount()), $this); endif; ?><br/>
		<?php if ($this->_tpl_vars['user']):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.authenticated",'userName' => ((is_array($_tmp=$this->_tpl_vars['grandChild']->getPosterName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this); elseif ($this->_tpl_vars['grandChild']->getPosterName()):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.anonymousNamed",'userName' => ((is_array($_tmp=$this->_tpl_vars['grandChild']->getPosterName())) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))), $this); else:  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.anonymous"), $this); endif; ?> (<?php echo ((is_array($_tmp=$this->_tpl_vars['grandChild']->getDatePosted())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>
)
	</li>
<?php endforeach; endif; unset($_from);  if ($this->_tpl_vars['grandChildren']): ?>
	</ul>
<?php endif; ?>

<?php endforeach; else: ?>
	<?php if (! $this->_tpl_vars['comment']): ?>
		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.noComments"), $this);?>

	<?php endif;  endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
