<?php /* Smarty version 2.6.9, created on 2005-07-08 06:01:59
         compiled from issue/issue.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'issue/issue.tpl', 20, false),)), $this); ?>

<?php $_from = $this->_tpl_vars['publishedArticles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sections'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sections']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['sectionTitle'] => $this->_tpl_vars['section']):
        $this->_foreach['sections']['iteration']++;
?>
<h4><?php echo $this->_tpl_vars['sectionTitle']; ?>
</h4>

<?php $_from = $this->_tpl_vars['section']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['article']):
?>
<table width="100%">
<tr valign="top">
	<td width="75%"><?php echo $this->_tpl_vars['article']->getArticleTitle(); ?>
</td>
	<td align="right" width="25%">
		<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/article/view/<?php echo $this->_tpl_vars['article']->getBestArticleId($this->_tpl_vars['currentJournal']); ?>
" class="file"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "issue.abstract"), $this);?>
</a>
		<?php if (( ! $this->_tpl_vars['subscriptionRequired'] || $this->_tpl_vars['article']->getAccessStatus() || $this->_tpl_vars['subscribedUser'] || $this->_tpl_vars['subscribedDomain'] )): ?>
		<?php $_from = $this->_tpl_vars['article']->getGalleys(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['galleyList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['galleyList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['galley']):
        $this->_foreach['galleyList']['iteration']++;
?>
			<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/article/view/<?php echo $this->_tpl_vars['article']->getBestArticleId($this->_tpl_vars['currentJournal']); ?>
/<?php echo $this->_tpl_vars['galley']->getGalleyId(); ?>
" class="file"><?php echo $this->_tpl_vars['galley']->getLabel(); ?>
</a>
		<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	</td>
</tr>
<tr>
	<td style="padding-left: 30px;font-style: italic;">
		<?php $_from = $this->_tpl_vars['article']->getAuthors(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['authorList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['authorList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['author']):
        $this->_foreach['authorList']['iteration']++;
?>
			<?php echo $this->_tpl_vars['author']->getFullName();  if (! ($this->_foreach['authorList']['iteration'] == $this->_foreach['authorList']['total'])): ?>,<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</td>
	<td align="right"><?php echo $this->_tpl_vars['article']->getPages(); ?>
</td>
</tr>
</table>
<?php endforeach; endif; unset($_from); ?>

<?php if (! ($this->_foreach['sections']['iteration'] == $this->_foreach['sections']['total'])): ?>
<div class="separator"></div>
<?php endif;  endforeach; endif; unset($_from); ?>