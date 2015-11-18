<style type="text/css">
    @import url(/JHShop/css/memberCss.css);
    @import url(/JHShop/css/adminCss.css);

</style>

<?php
session_start();
$pageselect= "pageNum".$action;
$pageInfo= "pageInfo".$action;
$pagenaviInfo=isset($_SESSION[$pageInfo])?$_SESSION[$pageInfo]:null;
$productList = isset($_SESSION[$pageselect])?$_SESSION[$pageselect]:null;
$cnt=1;
if($action%100==0){?>
<table>
    <?php if($cnt%3==0){
   echo"<tr>";}?>
    <?php foreach ($productList as $product) {
       echo "<td>";
            echo "<div id='product'>";
               echo "<ul>";
                    echo "<li>{$product['psimage']}</li><hr>";
                    echo "<li>{$product['pname']}</li>";
                    echo "<li>{$product['pcontent']}</li>";
                    echo "<li>{$product['pprice']}</li>";
                echo "</ul>";
            echo "</div>";
       echo "</td>";
        $cnt++;
    }?>
    <?php if($cnt%3==0){
        echo"</tr>"; $cnt=1;}?>
</table>
<?php}
include "{$value}/{$action}.php";
?>