<?php /* Smarty version Smarty-3.1.7, created on 2014-03-20 13:22:28
         compiled from "wiki:YouTube" */ ?>
<?php /*%%SmartyHeaderCode:742559434532b4e043708a9-17353753%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9021b9e9f915fb6dc3d4a9553ffa083176dbb70b' => 
    array (
      0 => 'wiki:YouTube',
      1 => 20140320202138,
      2 => 'wiki',
    ),
  ),
  'nocache_hash' => '742559434532b4e043708a9-17353753',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'width' => 0,
    'height' => 0,
    'playlist' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_532b4e043c713',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_532b4e043c713')) {function content_532b4e043c713($_smarty_tpl) {?><iframe width="<?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['width']->value, ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '425' : $tmp);?>
" height="<?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['height']->value, ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? 355 : $tmp);?>
" src="https://www.youtube.com/embed/<?php if (isset($_smarty_tpl->tpl_vars['playlist']->value)){?>?listType=playlist&list=<?php echo str_replace("%2F", "/", rawurlencode($_smarty_tpl->tpl_vars['playlist']->value));?>
<?php }else{ ?><?php echo str_replace("%2F", "/", rawurlencode($_smarty_tpl->tpl_vars['id']->value));?>
<?php }?>" frameborder="0" allowfullscreen></iframe><?php }} ?>