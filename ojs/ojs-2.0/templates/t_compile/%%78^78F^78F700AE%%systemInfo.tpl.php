<?php /* Smarty version 2.6.9, created on 2005-05-17 03:44:47
         compiled from admin/systemInfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin/systemInfo.tpl', 15, false),array('modifier', 'date_format', 'admin/systemInfo.tpl', 17, false),)), $this); ?>

<?php $this->assign('pageTitle', "admin.systemInformation");  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.systemVersion"), $this);?>
</h3>
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.currentVersion"), $this);?>
</h4>
<p><?php echo $this->_tpl_vars['currentVersion']->getVersionString(); ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['currentVersion']->getDateInstalled())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['datetimeFormatLong']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['datetimeFormatLong'])); ?>
)</p>

<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.versionHistory"), $this);?>
</h4>
<table class="listing" width="100%">
	<tr>
		<td colspan="6" class="headseparator">&nbsp;</td>
	</tr>
	<tr valign="top" class="heading">
		<td width="30%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.version"), $this);?>
</td>
		<td width="10%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.versionMajor"), $this);?>
</td>
		<td width="10%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.versionMinor"), $this);?>
</td>
		<td width="10%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.versionRevision"), $this);?>
</td>
		<td width="20%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.versionBuild"), $this);?>
</td>
		<td width="20%" align="right"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.dateInstalled"), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="6" class="headseparator">&nbsp;</td>
	</tr>
	<?php $_from = $this->_tpl_vars['versionHistory']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['versions'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['versions']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['version']):
        $this->_foreach['versions']['iteration']++;
?>
	<tr valign="top">
		<td><?php echo $this->_tpl_vars['version']->getVersionString(); ?>
</td>
		<td><?php echo $this->_tpl_vars['version']->getMajor(); ?>
</td>
		<td><?php echo $this->_tpl_vars['version']->getMinor(); ?>
</td>
		<td><?php echo $this->_tpl_vars['version']->getRevision(); ?>
</td>
		<td><?php echo $this->_tpl_vars['version']->getBuild(); ?>
</td>
		<td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['version']->getDateInstalled())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>
</td>
	</tr>
	<tr>
		<td colspan="6" class="<?php if (($this->_foreach['versions']['iteration'] == $this->_foreach['versions']['total'])): ?>end<?php endif; ?>separator">&nbsp;</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<br />

<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.systemConfiguration"), $this);?>
</h3>
<a class="action" href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/admin/editSystemConfig"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.edit"), $this);?>
</a>
<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.systemConfigurationDescription"), $this);?>
</p>

<?php $_from = $this->_tpl_vars['configData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sectionName'] => $this->_tpl_vars['sectionData']):
?>
<h4><?php echo $this->_tpl_vars['sectionName']; ?>
</h4>

<table class="data" width="100%">
<?php $_from = $this->_tpl_vars['sectionData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['settingName'] => $this->_tpl_vars['settingValue']):
?>
<tr valign="top">
	<td width="30%" class="label"><?php echo $this->_tpl_vars['settingName']; ?>
</td>
	<td width="70%"><?php if ($this->_tpl_vars['settingValue'] === true):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.on"), $this); elseif ($this->_tpl_vars['settingValue'] === false):  echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.off"), $this); else:  echo $this->_tpl_vars['settingValue'];  endif; ?></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php endforeach; endif; unset($_from); ?>

<div class="separator"></div>

<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.serverInformation"), $this);?>
</h3>
<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.serverInformationDescription"), $this);?>
</p>

<table class="data" width="100%">
<?php $_from = $this->_tpl_vars['serverInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['settingName'] => $this->_tpl_vars['settingValue']):
?>
<tr valign="top">
	<td width="30%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => $this->_tpl_vars['settingName']), $this);?>
</td>
	<td width="70%" class="value"><?php echo $this->_tpl_vars['settingValue']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<a href="<?php echo $this->_tpl_vars['pageUrl']; ?>
/admin/phpInfo" target="_blank"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.phpInfo"), $this);?>
</a>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>