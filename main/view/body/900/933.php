<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-23
 * Time: 오후 8:13
 */
$productData=isset($_SESSION["productData"])?$_SESSION["productData"]:null;

if(!$productData){
    echo "<h2>수정할 데이터가 없습니다.</h2>";
}
else{?>
    <form action="../controller/mainCTL.php">
        <input type="hidden" name="action" value="934">
        <div>
            <table>
                <tr width="550px">
                    <td>
                        <ul>
                            <li>
                                <?php if($productData['p_fimage']){ ?>
                                    <img src="../../img/pfimage/<?=$productData['p_fimage']?>">
                                <?php }else{?>
                                    <img src="../../img/static_img/NOIMG.jpg">
                                <?php } ?>
                            </li>
                            <li>
                                <input type="button" value="이미지 변경">
                            </li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>순번 &nbsp; <input type="text" readonly="true" name="p_num" value="<?=$productData['p_num']?>"</li>
                            <li>카테고리 &nbsp; <input type="text" name="p_category" value="<?=$productData['p_category']?>"</li>
                            <li>제품명 &nbsp; <input type="text" name="p_name" value="<?=$productData['p_name']?>"</li>
                            <li>재고량 &nbsp; <input type="text" name="p_stock" value="<?=$productData['p_stock']?>"</li>
                            <li>가격 &nbsp; <input type="text" name="p_price" value="<?=$productData['p_price']?>"</li>
                            <li>내용 &nbsp; <input type="text" name="p_content" value="<?=$productData['p_content']?>"</li>
                        </ul>
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="2"><input type="button" value="취소" onclick="location=history.back()"> <input type="submit" value="수정"></td>
                </tr>
            </table>
        </div>
    </form>
<?php } ?>


