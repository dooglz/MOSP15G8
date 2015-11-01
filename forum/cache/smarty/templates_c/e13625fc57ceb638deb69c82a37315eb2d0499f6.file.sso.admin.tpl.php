<?php /* Smarty version Smarty-3.1.16, created on 2015-11-01 20:03:08
         compiled from "C:\wamp\www\forum\sites\default\plugins\sso\admin\sso.admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1166256366ffcc42b82-57888576%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e13625fc57ceb638deb69c82a37315eb2d0499f6' => 
    array (
      0 => 'C:\\wamp\\www\\forum\\sites\\default\\plugins\\sso\\admin\\sso.admin.tpl',
      1 => 1438625715,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1166256366ffcc42b82-57888576',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_56366ffccd47a0_67248846',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56366ffccd47a0_67248846')) {function content_56366ffccd47a0_67248846($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_opt')) include 'C:\\wamp\\www\\forum/sys/CODOF/Smarty/plugins\\modifier.get_opt.php';
?><div class="col-md-6">
<form  action="index.php?page=ploader&plugin=sso" role="form" method="post" enctype="multipart/form-data">


SSO Name:
<input type="text" class="form-control" name="sso_name" value="<?php echo smarty_modifier_get_opt("sso_name");?>
" /><br/>
 
SSO Client ID:
<input type="text" class="form-control" name="sso_client_id" value="<?php echo smarty_modifier_get_opt("sso_client_id");?>
" /><br/>

SSO Secret:
<input type="text" class="form-control" name="sso_secret" value="<?php echo smarty_modifier_get_opt("sso_secret");?>
" /><br/>

SSO Get User Path:
<input type="text" class="form-control" name="sso_get_user_path" value="<?php echo smarty_modifier_get_opt("sso_get_user_path");?>
" /><br/>

SSO Login User Path:
<input type="text" class="form-control" name="sso_login_user_path" value="<?php echo smarty_modifier_get_opt("sso_login_user_path");?>
" /><br/>

SSO Logout User Path:
<input type="text" class="form-control" name="sso_logout_user_path" value="<?php echo smarty_modifier_get_opt("sso_logout_user_path");?>
" /><br/>

SSO Register User Path:
<input type="text" class="form-control" name="sso_register_user_path" value="<?php echo smarty_modifier_get_opt("sso_register_user_path");?>
" /><br/>

<input type="submit" value="Save" class="btn btn-primary"/>
</form>
<br/>
<br/>
</div><?php }} ?>
