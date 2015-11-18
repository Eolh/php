

<table>
	<tr>
<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-06
 * Time: 오후 2:14
 */
for($i=1;$i<=5;$i++){
	$codeNum=$MainMenuNum*100+$i*10;
?>
<td><a href="../controller/MainCTL.php?action=<?=$codeNum?>">SubMenu<?=$codeNum?></a></td>
<?php }?>
	</tr>
</table>