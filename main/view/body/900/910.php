<?php
/**
 * Created by PhpStorm.
 * User: JH
 * Date: 2015-11-06
 * Time: 오후 7:36
 */
$memberList = isset($_SESSION['memberList'])?$_SESSION['memberList']:null;
$memberPageInfo = isset($_SESSION['memberPageInfo'])?$_SESSION['memberPageInfo']:null;
?>

<div class="memberList">
    <h2>회원 정보 리스트</h2>
    <table align="center">
        <tr>
            <td>순번</td>
            <td>아이디</td>
            <td>비밀번호</td>
            <td>이름</td>
            <td>전화번호</td>
            <td>등급</td>
        </tr>
        <?php if( ! $memberList ){
        echo "<tr><td colspan='7'>저장된 데이터가 없습니다</td></tr>";
        }else {
        foreach ($memberList as $member) {
        echo "<tr>";
            foreach ($member as $myKey => $myValue) {
            echo "<td>";
                echo "$myValue";
                echo "</td>";
            }
            echo "<td><a href='../controller/MainCTL.php?action=916&num={$member['num']}'>UPD</a></td>";
            echo "<td><a href='../controller/MainCTL.php?action=917&num={$member['num']}&pageNum={$memberPageInfo['currentPageNum']}'>DEL</a></td>";
            echo "</tr>";
        }
        }?>
        <tr align="center"><td colspan="7"><?php include "./body/common/pageNavi.php";?></td></tr>
    </table>


</div>
