<?php
/* Smarty version 3.1.30, created on 2017-01-19 19:36:16
  from "/var/www/html/tmpl/TeamRegister_cmpl.tmpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58811530655ac5_95111530',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a6419047073d44c5d83e525e00bffd54d499e8be' => 
    array (
      0 => '/var/www/html/tmpl/TeamRegister_cmpl.tmpl',
      1 => 1484669895,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tmpl' => 1,
    'file:footer.tmpl' => 1,
  ),
),false)) {
function content_58811530655ac5_95111530 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LNS</title>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
      <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
    <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><?php echo '<script'; ?>
>var __adobewebfontsappname__="dreamweaver"<?php echo '</script'; ?>
><?php echo '<script'; ?>
 src="http://use.edgefonts.net/open-sans:n3,n8,n4:default;overlock:n4:default;poiret-one:n4:default;paytone-one:n4:default.js" type="text/javascript"><?php echo '</script'; ?>
>
  </head>
  <body>
    <?php $_smarty_tpl->_subTemplateRender("file:header.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div class="container-fluid">
      <div class="row">
        <h1>ご応募ありがとうございます</h1>
        <p>応募受付完了しました。記入していただいたアドレスにメールをお送りしますので確認お願いします。</p>
        <div class="col-md-2 col-md-offset-5">
          <a class="navbar-brand" href="/index.html"><input type="button" class="btn btn-default" value="戻る"></a>
        </div>
        <div class="col-lg-12 back"></div>
      </div>
    </div>
    <?php $_smarty_tpl->_subTemplateRender("file:footer.tmpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php echo '<script'; ?>
 src="js/jquery-1.11.3.min.js"><?php echo '</script'; ?>
>

    <!-- Include all compiled plugins (below), or include individual files as needed --> 
    <?php echo '<script'; ?>
 src="js/bootstrap.js"><?php echo '</script'; ?>
>
  </body>
</html><?php }
}
