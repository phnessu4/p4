<?php /* Smarty version 2.6.26, created on 2010-06-09 15:19:53
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>note</title>
<?php echo '
<style type="text/css">
#center {
	text-align: center;
	padding:100px 0px 100px;
}
#layout {
	margin:0px auto;
	width :800px;
	height:400px;
	text-align: left;
	padding:1px;
	background-color: AliceBlue;
	color: #000;
}
#layout a {
	margin:0px auto;
	width :800px;
	text-align: left;
	padding:1px;
	background-color: AliceBlue;
	color: SteelBlue;
}
#layout a:hover {
	color: Red;
}
#center #layout #layout_left {
	float:left;
	height:400px;
	width:300px;
	background-color: #CCC;
}
#center #layout #layout_right {
	float:left;
	width:500px;
	height:400px;
	background-color: #999;
}
#center #layout #layout_left #left_list {
	width:250px;
	height:300px;
	background-color: #0CF;
}
#center #layout #layout_left #left_share {
	width:250px;
	height:100px;
	background-color: #06F;
}
#center #layout #layout_right #right_form {
	width:400px;
	height:400px;
	background-color: #09F;
}
</style>
'; ?>

</head>
<body>
<div id="center">
  <div id="layout">
    <div id="layout_left">
      <div id="left_list">
        <dl>
          <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['foo']):
?>
          <dt><a href="index.php?id=<?php echo $this->_tpl_vars['foo']['id']; ?>
"><?php echo $this->_tpl_vars['foo']['title']; ?>
</a></dt>
          <?php endforeach; endif; unset($_from); ?>
        </dl>
      </div>
      <div id="left_share"></div>
    </div>
    <div id="layout_right">
      <form action="post.php" method="post">
        <div id="right_form">主题:<br/>
          <input type="text" name="title" id="title" value="<?php echo $this->_tpl_vars['post']['title']; ?>
">
          <br/>
          内容:<br/>
          <textarea name="content" id="content" cols="45" rows="5"><?php echo $this->_tpl_vars['post']['content']; ?>
</textarea>
          <br/>
          <input type="hidden" name="id" id="" value="<?php echo $this->_tpl_vars['post']['id']; ?>
">
          <input type="hidden" name="action" id="" value="<?php echo $this->_tpl_vars['action']; ?>
">
          <input type="submit" id="button" value="提交">
        </div>
      </form>
      <div id="right_form_hide"> </div>
    </div>
  </div>
</div>
</body>
</html>