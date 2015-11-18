<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-06
 * Time: 오후 2:14
 */include_once 'Header.php';
$level=0;
?>

<html>
	
	<head>
	    <meta charset="utf-8">
	    <title>G.AG</title>
	</head>

	<body>
<center>
		<div class="container">
			

			<div class="title"><?php include_once 'Title.php';?></div>

			<div class="topMenu"><?php include_once 'TopMenu.php';?></div>

			<hr>
			<div class="mainMenu"><?php include_once 'MainMenu.php';?></div>


			<div class="view">

			<?php if($MainMenuNum>0&& $MainMenuNum<=8){?>
				<div class="subMenu"><?php include_once 'SubMenu.php';?></div>
				<?php }?>
				<div class="mainBody"><?php include_once 'MainBody.php';?></div>
			</div>
			
			<div class="copyright"><?php include_once 'Copyright.php';?></div>
		
		</div>
</center>
	<div class="nav">
		<table><tr><td>aa</td>
				<td>aa</td>
				<td>aa</td></tr>
			<tr><td>aa</td>
				<td>aa</td>
				<td>aa</td></tr>
			<tr><td>aa</td>
				<td>aa</td>
				<td>aa</td></tr></table>
	</div>
	</body>
</html>
