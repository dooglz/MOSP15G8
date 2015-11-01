<?php /* Smarty version Smarty-3.1.16, created on 2015-11-01 20:02:31
         compiled from "C:\wamp\www\forum\admin\layout\templates\ui\themes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2369656366fd7d9ca06-68981006%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a830054d688777400f4ec026409bd262f1b4dc6' => 
    array (
      0 => 'C:\\wamp\\www\\forum\\admin\\layout\\templates\\ui\\themes.tpl',
      1 => 1438625713,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2369656366fd7d9ca06-68981006',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'themes' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_56366fd7e571b9_46975475',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56366fd7e571b9_46975475')) {function content_56366fd7e571b9_46975475($_smarty_tpl) {?><section class="content-header" id="breadcrumb_forthistemplate_hack">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb" style="float:left; left:10px;">
         <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li><i class="fa fa-laptop"></i> UI Elements</li>
         <li><i class="fa fa-image"></i> Themes</li>
    </ol>
    
</section>

<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['thm'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['thm']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['name'] = 'thm';
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['themes']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['thm']['total']);
?>
<div class="col-md-4">
    <div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title"><?php echo $_smarty_tpl->tpl_vars['themes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['thm']['index']]['name'];?>
</h3>

        </div>
        <div class="box-body">
            
            <img src="<?php echo $_smarty_tpl->tpl_vars['themes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['thm']['index']]['thumb'];?>
" style="width:250px" />
            <hr>
            <p>
                <?php echo $_smarty_tpl->tpl_vars['themes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['thm']['index']]['description'];?>

            </p>
        </div><!-- /.box-body -->
        <div class="box-footer">
        <?php if ($_smarty_tpl->tpl_vars['themes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['thm']['index']]['active']) {?> 
            Currently Active
         <?php } else { ?>   
        <form class="box-body" action="?page=ui/themes" role="form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="theme" value="<?php echo $_smarty_tpl->tpl_vars['themes']->value[$_smarty_tpl->getVariable('smarty')->value['section']['thm']['index']]['name'];?>
" />
            <input type="hidden" name="CSRF_token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
            <button class="btn btn-success">Activate</button>
        </form>
           <?php }?> 
        </div>
    </div>
</div>
<?php endfor; endif; ?><?php }} ?>
