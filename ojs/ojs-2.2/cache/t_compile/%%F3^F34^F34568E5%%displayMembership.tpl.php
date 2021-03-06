<?php /* Smarty version 2.6.18, created on 2007-12-11 22:59:31
         compiled from about/displayMembership.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'about/displayMembership.tpl', 19, false),array('modifier', 'escape', 'about/displayMembership.tpl', 19, false),)), $this); ?>
<?php $this->assign('pageTitle', "about.people"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h4><?php echo $this->_tpl_vars['group']->getGroupTitle(); ?>
</h4>
<?php $this->assign('groupId', $this->_tpl_vars['group']->getGroupId()); ?>

<?php $_from = $this->_tpl_vars['memberships']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
	<?php $this->assign('user', $this->_tpl_vars['member']->getUser()); ?>
	<a href="javascript:openRTWindow('<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'editorialTeamBio','path' => $this->_tpl_vars['user']->getUserId()), $this);?>
')"><?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getFullName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</a><?php if ($this->_tpl_vars['user']->getAffiliation()): ?>, <?php echo ((is_array($_tmp=$this->_tpl_vars['user']->getAffiliation())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
<?php endif; ?><?php if ($this->_tpl_vars['user']->getCountry()): ?><?php $this->assign('countryCode', $this->_tpl_vars['user']->getCountry()); ?><?php $this->assign('country', $this->_tpl_vars['countries'][$this->_tpl_vars['countryCode']]); ?>, <?php echo $this->_tpl_vars['country']; ?>
<?php endif; ?>
	<br />
<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>