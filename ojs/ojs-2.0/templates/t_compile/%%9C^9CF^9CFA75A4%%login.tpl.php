<?php /* Smarty version 2.6.9, created on 2005-05-17 03:44:56
         compiled from user/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'user/login.tpl', 17, false),array('modifier', 'escape', 'user/login.tpl', 22, false),)), $this); ?>

<?php $this->assign('pageTitle', "user.login");  $this->assign('helpTopicId', "user.registerAndProfile");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['error']): ?>
	<span class="formError"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => ($this->_tpl_vars['error'])), $this);?>
</span>
	<br /><br />
<?php endif; ?>

<form name="login" action="<?php echo $this->_tpl_vars['pageUrl']; ?>
/login/signIn" method="post">
<input type="hidden" name="source" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['source'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<table class="data">
<tr>
	<td class="label"><label for="loginUsername"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.username"), $this);?>
</label></td>
	<td class="value"><input type="text" id="loginUsername" name="username" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['username'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="20" maxlength="32" class="textField" /></td>
</tr>
<tr>
	<td class="label"><label for="loginPassword"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.password"), $this);?>
</label></td>
	<td class="value"><input type="password" id="loginPassword" name="password" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="20" maxlength="32" class="textField" /></td>
</tr>
<?php if ($this->_tpl_vars['showRemember']): ?>
<tr valign="middle">
	<td></td>
	<td class="value"><input type="checkbox" id="loginRemember" name="remember" value="1"<?php if ($this->_tpl_vars['remember']): ?> checked="checked"<?php endif; ?> /> <label for="loginRemember"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.login.rememberUsernameAndPassword"), $this);?>
</label></td>
</tr>
<?php endif; ?>
<tr>
	<td></td>
	<td><input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.signIn"), $this);?>
" class="button" /></td>
</tr>
</table>
</form>

<p>
&#187; <a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/user/register"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.login.registerNewAccount"), $this);?>
</a><br />
&#187; <a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/login/lostPassword"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.login.forgotPassword"), $this);?>
</a>
</p>

<script type="text/javascript">document.login.<?php if ($this->_tpl_vars['username']): ?>password<?php else: ?>username<?php endif; ?>.focus();</script>
</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>